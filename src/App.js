/**
 * DUHET NODE JS per te nis projektin
 * 
 * 'npm install' -  shkarkon librarite qe kam perdor
 * 
 * step1: ne terminal bej run  'node server.js'
 * step2: ne terminal bej run npm start
 * 
 * kur i ben submit me emial/password dosido; cohet 1 request tek localhost/login
 * pastaj server.js kthen nje TOKEN.
 * TOKEN ruhet ne session Storage 
 * 
 * nqs ske token nuk futesh dot tek /home ose/receptionist
 * 
 * faqet tjera do perpunohen ne vazhdim
 * 
 */


import React, {useState} from "react";
import useToken from './useToken';

import './dist/tailwind.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import NavigationBar from './Components/NavigationBar';
import LoginPage from "./Pages/LoginPage";
import AdminPage from './Pages/AdminPage';
import ReceptionistPage from './Pages/ReceptionistPage';
// import NoMatch from './Pages/NoMatch';
// import FinancePage from './Pages/FinancePage';
// import ClientPage from './Pages/ClientPage';
// import Form from './Pages/Form';
import Footer from './Components/Footer';

import {
  BrowserRouter as Router,
  Switch,
  Route,
  // Link
} from "react-router-dom";

function App() {

  const {token,setToken} = useToken();
  
  if (!token) {
    return <LoginPage setToken={setToken} />
  }

  return (

    <React.Fragment>
      <NavigationBar />

      {/* <Form/> */}

      <Router>
        <Switch>
          <Route path="/home" component={AdminPage} />
          <Route path="/receptionist" component={ReceptionistPage} />
          {/* <Route path="/user" component={ClientPage} /> */}
          {/* <Route path="/finance" component={FinancePage} /> */}
          {/* <Route path="/form" component={Form} /> */}
          {/* <Route component={NoMatch} /> */}

        </Switch>
      </Router>


      <Footer />

    </React.Fragment>
  )


}

export default App;
