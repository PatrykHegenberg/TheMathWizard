package views

import (
	"github.com/chasefleming/elem-go"
	"github.com/chasefleming/elem-go/attrs"
)

func RenderHead() elem.Node {
	headContent := elem.Head(nil,
		elem.Meta(attrs.Props{attrs.Charset: "UTF-8", attrs.Name: "viewport", attrs.Content: "width=device-width, initial-scale=1.0"}),
		elem.Meta(attrs.Props{attrs.HTTPequiv: "X-UA-Compatible", attrs.Content: "IE=edge"}),
		elem.Script(attrs.Props{attrs.Src: "https://unpkg.com/htmx.org"}),
		elem.Title(nil, elem.Text("The Math Wizard")),
		elem.Link(attrs.Props{attrs.Href: "https://cdn.jsdelivr.net/npm/nes.css@2.3.0/css/nes.min.css", attrs.Rel: "stylesheet"}),
		elem.Link(attrs.Props{attrs.Rel: "stylesheet", attrs.Href: "https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"}),
		elem.Link(attrs.Props{attrs.Rel: "stylesheet", attrs.Href: "/static/styles/style.css"}),
		elem.Script(attrs.Props{attrs.Src: "https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"}),
		elem.Style(nil, elem.Text("@import url('https://fonts.googleapis.com/css2?family=Press+Start+2P');")),
	)
	return headContent
}
