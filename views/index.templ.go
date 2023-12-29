package views

import (
	"github.com/chasefleming/elem-go"
	"github.com/chasefleming/elem-go/attrs"
)

func RenderIndex() string {
	headContent := RenderHead()
	navContent := RenderNav()
	mainContent := RenderMain()
	footerContent := RenderFooter()
	bodyContent := elem.Body(attrs.Props{attrs.Class: "is-boxed"},
		elem.Div(attrs.Props{attrs.Class: "body-wrap boxed-container"},
			navContent,
			mainContent,
			footerContent,
		),
	)

	htmlContent := elem.Html(nil, headContent, bodyContent)

	return htmlContent.Render()
}
