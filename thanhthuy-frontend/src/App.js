import React from 'react'
import AppBar from './scenes/global/AppBar'
import Banner from './scenes/global/Banner'
import NavBar from './scenes/global/NavBar'
import Footer from './scenes/global/Footer'
import Copyright from './scenes/global/Copyright'
import { Outlet } from 'react-router-dom'
import { Provider } from 'react-redux';
import store from './state/store';
export default function App() {
  return (
    <div>
      <Provider store={store}>
        <AppBar />
        <div className='container'>
          <Banner />
          <NavBar />
          <Outlet />
          <Footer />
          
        </div>  
        <Copyright />
      </Provider>
    </div>
  )
}