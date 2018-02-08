import React, {StyleSheet, Dimensions, PixelRatio} from "react-native";
const {width, height, scale} = Dimensions.get("window"),
    vw = width / 100,
    vh = height / 100,
    vmin = Math.min(vw, vh),
    vmax = Math.max(vw, vh);

export default StyleSheet.create({
    "*": {
        "paddingTop": 0,
        "paddingRight": 0,
        "paddingBottom": 0,
        "paddingLeft": 0,
        "marginTop": 0,
        "marginRight": 0,
        "marginBottom": 0,
        "marginLeft": 0
    },
    "row": {
        "width": "100.9%"
    },
    "botline": {
        "borderBottom": "1px solid #fff"
    },
    "border-b": {
        "borderRadius": 30
    },
    "orf": {
        "marginTop": "8%",
        "marginLeft": "-15%",
        "width": "40%"
    },
    "header": {
        "width": "45%",
        "background": "#D33F4B",
        "height": 18.5 * vh,
        "zIndex": 1000000,
        "position": "absolute",
        "marginLeft": "50%",
        "marginTop": -8 * vh
    },
    "div img": {
        "display": "flex",
        "float": "left",
        "width": "51%"
    },
    "imgtop": {
        "paddingTop": "absolute",
        "paddingRight": "absolute",
        "paddingBottom": "absolute",
        "paddingLeft": "absolute",
        "width": "100%",
        "height": 25 * vh
    },
    "imgtop img": {
        "width": "79%"
    },
    "menu": {
        "width": "100%"
    },
    "menu ul": {
        "marginTop": "10%",
        "width": "100%",
        "display": "block"
    },
    "menu ul li": {
        "paddingTop": "4%",
        "paddingRight": "4%",
        "paddingBottom": "4%",
        "paddingLeft": "4%",
        "display": "inline-block"
    },
    "menu ul li span": {
        "fontSize": "200%",
        "transition": "all .4s",
        "color": "#fff"
    },
    "menu ul li span:hover": {
        "color": "#000"
    },
    "submenu": {
        "paddingTop": "4%",
        "paddingRight": "4%",
        "paddingBottom": "4%",
        "paddingLeft": "4%",
        "backgroundColor": "#D33F4B",
        "width": "600%",
        "borderRadius": 10
    },
    "submenu li a": {
        "width": "100%",
        "overflow": "hidden",
        "transition": "all .4s",
        "paddingTop": "2%",
        "paddingRight": "2%",
        "paddingBottom": "2%",
        "paddingLeft": "2%"
    },
    "submenu li a:hover": {
        "width": "100%",
        "overflow": "hidden",
        "backgroundColor": "#fff",
        "color": "#D33F4B",
        "transition": "all .4s"
    },
    "ul": {
        "listStyle": "none"
    },
    "ol": {
        "listStyle": "none"
    },
    "nav": {
        "background": "#1C4056",
        "width": "100%",
        "marginTop": 0,
        "marginRight": "auto",
        "marginBottom": 0,
        "marginLeft": "auto"
    },
    "nav > li": {
        "float": "left"
    },
    "nav li a img": {
        "position": "absolute",
        "display": "flex",
        "width": "100%"
    },
    "nav li a": {
        "color": "#fff",
        "textDecoration": "none",
        "paddingTop": 10,
        "paddingRight": 12,
        "paddingBottom": 10,
        "paddingLeft": 12,
        "width": "100%",
        "display": "block"
    },
    "nav li a:hover": {
        "width": "100%",
        "backgroundColor": "#ffffff",
        "color": "#D33F4B",
        "transition": "all .4s"
    },
    "nav li ul": {
        "display": "none",
        "position": "absolute",
        "minWidth": "100%"
    },
    "linea": {
        "borderLeft": "2px solid #fff"
    },
    "nav li:hover > ul": {
        "zIndex": 100000,
        "display": "block"
    },
    "nav li ul li": {
        "position": "relative"
    },
    "nav li ul li ul": {
        "right": -140,
        "top": 0
    },
    "bot": {
        "zIndex": 10000000000,
        "position": "absolute",
        "width": "45%",
        "marginTop": "-3%",
        "marginLeft": "25%",
        "display": "inline-block",
        "backgroundColor": "#1A3F5E",
        "borderRadius": "20px 20px 0 0"
    },
    "bot nav": {
        "width": "100%"
    },
    "bot nav ul": {
        "width": "100%",
        "display": "block"
    },
    "bot nav ul li a img": {
        "width": "10%",
        "paddingTop": "2%",
        "paddingRight": "2%",
        "paddingBottom": "2%",
        "paddingLeft": "2%",
        "display": "inline-block",
        "float": "left",
        "transition": "all .4s"
    },
    "bot nav ul li a span": {
        "paddingTop": "2%",
        "paddingRight": "2%",
        "paddingBottom": "2%",
        "paddingLeft": "2%",
        "fontSize": "150%",
        "color": "#fff",
        "display": "inline-block",
        "float": "left",
        "transition": "all .4s"
    },
    "bot nav ul li a span:hover": {
        "paddingTop": "3%",
        "paddingRight": "3%",
        "paddingBottom": "3%",
        "paddingLeft": "3%",
        "color": "#000",
        "transition": "all .4s"
    }
});