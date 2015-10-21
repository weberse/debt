import React, { Component } from 'react';

export default class Header extends Component {
	render() {
		return (
            <header>
                <div className="content pure-g">
                    <div className="pure-u-1-5">
                        <div className="pure-menu">
                            <button className="pure-button  pure-button-primary">New</button>
                        </div>
                    </div>
                    <div className="pure-u-1-2">
                    </div>
                    <div className="pure-u-1-5">
                    	<a className="pure-button" href="/login">login</a>
                    </div>
                </div>
            </header>
		);
	}
}