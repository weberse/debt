import React, { Component } from 'react';
import Header from './header'

export default class Menu extends Component {
    render() {
        let menu = this.props.menu;
        return (
            <div className="">
                <Header />
            </div>
        );
    }
}