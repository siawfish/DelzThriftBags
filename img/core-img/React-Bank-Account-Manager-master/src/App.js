import React, { Component } from 'react';
import './index.css'
import Home from './Home';
import AddAccount from './AddAccount';
import { BrowserRouter, Route } from 'react-router-dom';
import EditAccount from './EditAccount';
class App extends Component {
  render() {
    return (
      <BrowserRouter>
        <Route component={Home} path="/" exact/>
        <Route component={AddAccount} path="/add" exact/>
        <Route component={EditAccount} path="/edit/:id" exact/>
      </BrowserRouter>
    );
  }
}
export default App;