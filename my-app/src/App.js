import Start from './components/Home';
import Add from './components/Add';
import DetailPage from './components/Detail';
import React, { useState, useEffect, Component } from 'react';


import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

class App extends Component {
  render() {
    return(
      <Router>
      <div>
        <Route path="/" component={Start} exact/>
        <Route path="/add" component={Add}/>
        <Route path="/detail/:id" component={DetailPage} />

        
      </div>
      </Router>
    )
  }
}

export default App;