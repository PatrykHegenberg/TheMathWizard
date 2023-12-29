package main

import (
	"crypto/sha256"
	"database/sql"
	"encoding/hex"
	"fmt"
	"os"

	_ "github.com/go-sql-driver/mysql"
	"github.com/joho/godotenv"
	"github.com/labstack/echo/v4"
)

var db *sql.DB

func init() {
	err := godotenv.Load()
	if err != nil {
		fmt.Println("Error loading .env file")
		os.Exit(1)
	}

	dbHost := os.Getenv("DB_Host")
	dbPort := os.Getenv("DB_Port")
	dbName := os.Getenv("DB_Name")
	dbCharset := os.Getenv("DB_Charset")
	dbUser := os.Getenv("DB_User")
	dbPassword := os.Getenv("DB_Password")

	// Connect to the database
	db, err = sql.Open("mysql", fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?charset=%s", dbUser, dbPassword, dbHost, dbPort, dbName, dbCharset))
	//	db, err = sql.Open("mysql", fmt.Sprintf("%s:%s@tcp(db:3306)/%s?charset=utf8mb4", dbUser, dbPassword, dbName))

	if err != nil {
		fmt.Println("Error connecting to the database")
		os.Exit(1)
	}
}

// User struct
type User struct {
	ID          int          `json:"id"`
	Username    string       `json:"username"`
	Vorname     string       `json:"vorname"`
	Nachname    string       `json:"nachname"`
	Email       string       `json:"email"`
	Password    string       `json:"password"`
	LessonCount int          `json:"lesson_count"`
	Level       int          `json:"level"`
	XP          int          `json:"xp"`
	Coins       int          `json:"coins"`
	IsAdmin     sql.NullBool `json:"is_admin"`
}

// CRUD operations

func getUsers(c echo.Context) error {
	rows, err := db.Query("SELECT * FROM user")
	if err != nil {
		return err
	}
	defer rows.Close()

	users := []User{}
	for rows.Next() {
		user := User{}
		err := rows.Scan(&user.ID, &user.Username, &user.Vorname, &user.Nachname, &user.Email, &user.Password, &user.LessonCount, &user.Level, &user.XP, &user.Coins, &user.IsAdmin)
		if err != nil {
			return err
		}
		users = append(users, user)
	}

	return c.JSON(200, users)
}

func getUser(c echo.Context) error {
	id := c.Param("id")

	row := db.QueryRow("SELECT * FROM user WHERE id = ?", id)

	user := User{}
	err := row.Scan(&user.ID, &user.Username, &user.Vorname, &user.Nachname, &user.Email, &user.Password, &user.LessonCount, &user.Level, &user.XP, &user.Coins, &user.IsAdmin)
	if err != nil {
		return err
	}

	return c.JSON(200, user)
}

func createUser(c echo.Context) error {
	user := new(User)
	if err := c.Bind(user); err != nil {
		return err
	}

	// Hash das Passwort
	user.Password = hashPassword(user.Password)

	result, err := db.Exec("INSERT INTO user (username, vorname, nachname, email, password, lesson_count, level, xp, coins, isAdmin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
		user.Username, user.Vorname, user.Nachname, user.Email, user.Password, user.LessonCount, user.Level, user.XP, user.Coins, user.IsAdmin)
	if err != nil {
		return err
	}

	lastInsertID, err := result.LastInsertId()
	if err != nil {
		return err
	}

	user.ID = int(lastInsertID)

	return c.JSON(201, user)
}

func updateUser(c echo.Context) error {
	id := c.Param("id")

	user := new(User)
	if err := c.Bind(user); err != nil {
		return err
	}

	_, err := db.Exec("UPDATE user SET username = ?, vorname = ?, nachname = ?, email = ?, password = ?, lesson_count = ?, level = ?, xp = ?, coins = ?, isAdmin = ? WHERE id = ?",
		user.Username, user.Vorname, user.Nachname, user.Email, user.Password, user.LessonCount, user.Level, user.XP, user.Coins, user.IsAdmin, id)
	if err != nil {
		return err
	}

	return c.NoContent(204)
}

func deleteUser(c echo.Context) error {
	id := c.Param("id")

	_, err := db.Exec("DELETE FROM user WHERE id = ?", id)
	if err != nil {
		return err
	}

	return c.NoContent(204)
}

func hashPassword(password string) string {
	hash := sha256.Sum256([]byte(password))
	return hex.EncodeToString(hash[:])
}
