package views

import (
	"fmt"

	"github.com/chasefleming/elem-go"
	"github.com/chasefleming/elem-go/attrs"
)

type Stats struct {
	Username string
}

func RenderProfile() elem.Node {
	stats := Stats{
		Username: "TestUser",
	}
	page := elem.Div(attrs.Props{attrs.Class: "profile"},
		elem.Div(attrs.Props{attrs.Style: "padding: 20px; border-radius: 5px; box-shadow: 0 0 4px #433e4c; margin-top: 20px; margin-bottom: 20px; background-color: #2e1e26;"},
			elem.Div(attrs.Props{attrs.Class: "container3"},
				elem.Section(attrs.Props{attrs.Class: "message-list"},
					elem.Section(attrs.Props{attrs.Class: "message -left"},
						elem.I(attrs.Props{attrs.Class: "nes-bcrikko"}),
						elem.Div(attrs.Props{attrs.Class: "nes-balloon from-left"},
							elem.P(nil, elem.Text(fmt.Sprintf("Hallo %s zurück. Wie kann ich dir helfen?", stats.Username))),
						),
					),
				),
				elem.Div(attrs.Props{attrs.Class: "container3"},
					elem.Div(attrs.Props{attrs.Class: "text-center"},
						elem.H3(nil, elem.Text("Was möchtest du tun?"))),
				),
				elem.Div(nil,
					elem.A(attrs.Props{attrs.Class: "nes-btn", attrs.Href: "/learn"}, elem.Text("Lernen")),
					elem.A(attrs.Props{attrs.Class: "nes-btn", attrs.Href: "/play"}, elem.Text("Spielen")),
				),
			),
			elem.Div(attrs.Props{attrs.Class: "container3"},
				elem.Span(attrs.Props{attrs.Class: "title"}, elem.Text("Dein Fortschritt")),
				elem.Span(nil, elem.Text("Du bist aktuell Leven: ")),
			),
		),
	)

	return page
}
