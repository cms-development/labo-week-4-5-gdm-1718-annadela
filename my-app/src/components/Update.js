import React, { Component } from 'react';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

let postClick = (title,content) =>{
  fetch('http://localhost:85/wp/wp-json/jwt-auth/v1/token',{
      method: "POST",
      headers:{
          'Content-Type': 'application/json',
          'accept': 'application/json',
          
      },
      body:JSON.stringify({
          username: 'root',
          password: 'secret'
      })
  }).then(function(response){
      return response.json();
  }).then((user) => {

      fetch('http://localhost:85/wp/wp-json/wp/v2/creatures/',{
          method: "POST",
          headers:{
              'Content-Type': 'application/json',
              'accept': 'application/json',
              'Authorization': 'Bearer ' + user.token
          },
          body:JSON.stringify({
              title: title,
              content: content,
              status: 'publish'
          })
      }).then(() => {
          console.log('posted')
      })
      }
  );
    
}

class Home extends Component {
  render(){
    return(
      <div>
        <h1>Add</h1>

      <form onSubmit={this.handleSubmit}>
        <input name="title" id="title" type="text" placeholder="title"/>
        <input name="content" id="content" type="text" placeholder="content"/>
        <input name="xp" id="xp" type="text" placeholder="xp"/>
        <button type="Submit">add</button>
      </form>
      </div>
    )
  }
}

export default Home;