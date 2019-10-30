import React, { Component } from 'react';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

let postClick = (title,content,xp) =>{
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


  

class Add extends Component {

  handleSubmit = (event) => {
    event.preventDefault();
    console.log('test');
    let title = document.getElementById('title').value;
    let content = document.getElementById('content').value;
    let xp = document.getElementById('xp').value;
    postClick(title, content,xp);
  
  }
  
  render(){
    return(
      <div>
        <ul className="header">
          <li><a href="/">Home</a></li>
          <li><a href="/add">Add</a></li>
        </ul>
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

export default Add;