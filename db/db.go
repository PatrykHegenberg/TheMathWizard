package main

import (
	"database/sql"
	"fmt"

	_ "github.com/go-sql-driver/mysql"
)

// Connect to MySQL database.
type Database struct {
	connection *sql.DB
	statement  *sql.Stmt
}

func NewDatabase(config map[string]string, username string, password string) (*Database, error) {
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s", username, password, config["host"], config["port"], config["dbname"])
	db, err := sql.Open("mysql", dsn)
	if err != nil {
		return nil, err
	}

	return &Database{
		connection: db,
	}, nil
}

func (d *Database) Query(query string, params ...interface{}) (*Database, error) {
	stmt, err := d.connection.Prepare(query)
	if err != nil {
		return nil, err
	}

	d.statement = stmt

	_, err = stmt.Exec(params...)
	if err != nil {
		return nil, err
	}

	return d, nil
}

func (d *Database) Find() (map[string]interface{}, error) {
	result := make(map[string]interface{})
	err := d.statement.QueryRow().Scan(result)
	if err != nil {
		return nil, err
	}

	return result, nil
}

func (d *Database) FindOrFail() (map[string]interface{}, error) {
	result, err := d.Find()
	if err != nil {
		return nil, err
	}

	if result == nil {
		return nil, fmt.Errorf("Record not found")
	}

	return result, nil
}

func (d *Database) Get() ([]map[string]interface{}, error) {
	rows, err := d.statement.Query()
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	columns, err := rows.Columns()
	if err != nil {
		return nil, err
	}

	result := make([]map[string]interface{}, 0)
	values := make([]interface{}, len(columns))
	valuePtrs := make([]interface{}, len(columns))
	for rows.Next() {
		for i := 0; i < len(columns); i++ {
			valuePtrs[i] = &values[i]
		}

		err := rows.Scan(valuePtrs...)
		if err != nil {
			return nil, err
		}

		entry := make(map[string]interface{})
		for i, col := range columns {
			val := values[i]
			b, ok := val.([]byte)
			if ok {
				entry[col] = string(b)
			} else {
				entry[col] = val
			}
		}

		result = append(result, entry)
	}

	return result, nil
}

func (d *Database) Delete(params string) (*Database, error) {
	_, err := d.Query("DELETE FROM user WHERE username = ?", params)
	if err != nil {
		return nil, err
	}

	return d, nil
}

func (d *Database) Update(params map[string]interface{}) (*Database, error) {
	_, err := d.Query("UPDATE user SET level = ?, xp = ?, coins = ? WHERE username = ?", params["level"], params["xp"], params["coins"], params["username"])
	if err != nil {
		return nil, err
	}

	return d, nil
}

func (d *Database) GetPlayerStats(params string) (map[string]interface{}, error) {
	result, err := d.Query("SELECT username, level, lesson_count, xp, coins FROM user WHERE username = ?", params).Get()
	if err != nil {
		return nil, err
	}

	if len(result) == 0 {
		return nil, fmt.Errorf("Record not found")
	}

	return result[0], nil
}
