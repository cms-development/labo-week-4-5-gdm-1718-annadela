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

class App extends Component {
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

  
  handleSubmit = (event) => {
    event.preventDefault();
    console.log('test');
    let title = document.getElementById('title').value;
    let content = document.getElementById('content').value;
    let xp = document.getElementById('xp').value;
    postClick(title, content);
  
  }
   


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

   render() {
     if(this.state.isLoaded == false){
       console.log('Loading')
       return(
         <h1>Loading</h1>
       )
     }else {
      console.log(this.state.data)
     
        return (
          <div>
            <h2>Home</h2>
            {this.state.data.map((data, key) =>
          // console.log(data.title.rendered)
          <div>
        <li key={'title'+data.id}>{data.title.rendered}</li>
        <li key={'xp'+data.id}>{data.acf.xp}</li>
        <li key={'spell'+data.id}>{data.acf.spell}</li>
        <li key={'confoundable'+data.id}>{data.acf.confoundable}</li>
        <li key={'image'+data.id}><img src={data.acf.image}/></li>
        <li><a href="">detail</a></li>
        <button key={'button'+ data.id} onClick={() => { this.deleteClick(data.id) }}>delete</button>
        <a href={`/creature/${data.id}`}>Show details</a>
      </div>)}
  
      <form onSubmit={this.handleSubmit}>
        <input name="title" id="title" type="text" placeholder="title"/>
        <input name="content" id="content" type="text" placeholder="content"/>
        <input name="xp" id="xp" type="text" placeholder="xp"/>
  
  
        <button type="Submit">add</button>
      </form>
      </div>
      )
  
      function Add () {
        return <h2>add</h2>;
      }
  
      function Update() {
        return <h2>update</h2>;
      }

      return(
          <Router>
            <div>
              <nav>
                <ul>
                  <li>
                    <Link to="/">Home</Link>
                  </li>
                  <li>
                    <Link to="/add">Add</Link>
                  </li>
                  <li>
                    <Link to="/update">update</Link>
                  </li>
                </ul>
              </nav>
      
              {/* A <Switch> looks through its children <Route>s and
                  renders the first one that matches the current URL. */}
              <Switch>
                <Route path="/add">
                  <Add />
                </Route>
                <Route path="/update">
                  <Update />
                </Route>
              </Switch>
            </div>
          </Router>
    
          
      )
     }
   }
   
}