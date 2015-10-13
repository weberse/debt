import React, { Component } from 'react'
import { Router, Route, Link } from 'react-router'
import Main from './components/main'

export default class App extends Component {
    render() {
        let menu = this.props.menu;
        return (
            <Router>
                <Route path="/" component={Webpage} >
                    <Route path="webpage/:layout" component={Webpage} />
                </Route>
            </Router>
        );
    }
}