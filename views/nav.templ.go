package views

import (
	"github.com/chasefleming/elem-go"
	"github.com/chasefleming/elem-go/attrs"
)

func RenderNav() elem.Node {
	navContent := elem.Header(attrs.Props{attrs.Class: "site-header"},
		elem.Div(attrs.Props{attrs.Class: "container"},
			elem.Nav(nil,
				elem.Div(attrs.Props{attrs.Class: "site-header-inner"},
					elem.A(attrs.Props{attrs.Class: "", attrs.Href: "/"}),
				),
			),
		),
	)
	return navContent
}
