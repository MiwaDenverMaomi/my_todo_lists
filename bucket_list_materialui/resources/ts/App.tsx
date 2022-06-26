import React from 'react';
import { Container, CssBaseline, Box } from '@mui/material';
import Footer from './components/Footer';
import MenuBar from './components/MenuBar';
import Router from './Router';

const App = () => {
  console.log('app');
  return (
    <div id="wrapper">
      <CssBaseline />
      <MenuBar />
      <Router />
      <Footer />
    </div>
  );
}

export default App;
