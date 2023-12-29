package main

import (
	// "fmt"
	"net/http"
	// "os"
	// "os/exec"
	// "runtime"
	// "strconv"

	// "github.com/chasefleming/elem-go"
	// "github.com/chasefleming/elem-go/attrs"
	// "github.com/chasefleming/elem-go/htmx"
	"the_math_wizard/views"

	"github.com/labstack/echo/v4"
	"github.com/labstack/echo/v4/middleware"
)

func main() {
	e := echo.New()
	e.Static("/static", "assets")

	// Middleware
	e.Use(middleware.Logger())
	e.Use(middleware.Recover())

	// Routes
	e.GET("/", RenderIndexRoute)
	e.GET("/learn", RenderLearnRoute)
	e.GET("/mathe", RenderMatheRoute)
	e.GET("/game", RenderGameRoute)
	e.GET("/login", RenderLoginRoute)
	e.GET("/register", RenderRegisterRoute)
	e.GET("/profile", RenderProfileRoute)
	e.GET("/logout", LogoutRoute)
	e.GET("/delete", DeleteRoute)
	e.GET("/updateData", RenderUpdateRoute)
	e.GET("/deleteUser", RenderDeleteRoute)

	// Start the server
	e.Logger.Fatal(e.Start(":3000"))

}

func RenderIndexRoute(c echo.Context) error {
	return c.HTML(http.StatusOK, views.RenderIndex())
}
func RenderLearnRoute(c echo.Context) error {
	return nil
}
func RenderMatheRoute(c echo.Context) error {
	return nil
}
func RenderGameRoute(c echo.Context) error {
	return nil
}
func RenderLoginRoute(c echo.Context) error {
	return nil
}
func RenderRegisterRoute(c echo.Context) error {
	return nil
}
func RenderProfileRoute(c echo.Context) error {
	return nil
}
func LogoutRoute(c echo.Context) error {
	return nil
}
func DeleteRoute(c echo.Context) error {
	return nil
}
func RenderUpdateRoute(c echo.Context) error {
	return nil
}
func RenderDeleteRoute(c echo.Context) error {
	return nil
}
