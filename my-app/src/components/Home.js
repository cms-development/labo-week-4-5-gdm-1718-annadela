import React, { useState, useEffect, Component } from 'react';

import detailCreature from './Detail';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

class Home extends Component {
  constructor(props){
    super(props);
    this.state = {
      isLoaded: false,
      data: null,
   }
  };

  componentDidMount () {
    fetch('http://localhost:85/wp/wp-json/wp/v2/creatures/', {
     method: 'get',
    })
    .then(response => response.json())
    // .then(data => console.log(data));
    .then(data => this.setState({ 
      isLoaded: true,
      data,
     }));
   };


   deleteClick = userId => {
    let userToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODUiLCJpYXQiOjE1NzI0MzA0MzQsIm5iZiI6MTU3MjQzMDQzNCwiZXhwIjoxNTczMDM1MjM0LCJkYXRhIjp7InVzZXIiOnsiaWQiOiIxIn19fQ.kENDnCEmJ6ioJ9J58-GzGbiIq6ixbDfY_U7Axaw8-1s'
    const requestOptions = {
      method: 'DELETE'
    };
    fetch("http://localhost:85/wp/wp-json/wp/v2/creatures/" + userId,  
    {
      headers:{
      'Authorization': 'Bearer '+ userToken
    },
    method: 'DELETE'
  })
    .then((response) => {
      return response.json();
    }).then((result) => {
      console.log(result)
    });
  }  


  render(){
    if(this.state.isLoaded == false){
      console.log('Loading')
      return(
        <h1>Loading</h1>
      )
    }else {
      console.log(this.state.data)
      return (
        
        <div>
          <ul className="header">
          <li><a href="/">Home</a></li>
          <li><a href="/add">Add</a></li>
        </ul>
          <h2>Welkom</h2>
          {this.state.data.map((data, key) =>
          <div>
            <li key={'title'+data.id}><strong>{data.title.rendered}</strong></li>
            <li key={'content'+data.id}>{data.content.rendered}</li>
            <li key={'xp'+data.id}>Xp: {data.acf.xp}</li>
            <li key={'spell'+data.id}>spell: {data.acf.spell}</li>
            <li key={'confoundable'+data.id}>confoundable: {data.acf.confoundable}</li>
            <li key={'image'+data.id}><img src={data.acf.image}/></li>
            <button key={'button'+ data.id} onClick={() => { this.deleteClick(data.id) }}>delete</button>
              <a href={`/detail/${data.id}`}>Show details</a>

          </div>)}
        </div>
    )}
 
  }
}

export default Home;