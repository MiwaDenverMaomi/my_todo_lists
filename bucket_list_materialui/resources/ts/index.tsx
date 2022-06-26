import React from 'react';
import { BrowserRouter } from 'react-router-dom';
import  thunk from 'redux-thunk';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware,compose } from '@reduxjs/toolkit';
import ReactDOM from 'react-dom';
import './css/index.css';
import App from './App';
// import reducers from './reducers';

// const middlewares = [thunk];
// const composeReduxDevToolsEnhancers = typeof window === 'object' && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;
// interface ExtendedWindow extends Window {
//   __REDUX_DEVTOOLS_EXTENSION_COMPOSE__?: typeof compose;
// }
// const store = createStore(
//   reducers,
//   applyMiddleware(thunk)
//   // composeReduxDevToolsEnhancers(applyMiddleware(...middlewares))
// );

// declare var window: ExtendedWindow;

ReactDOM.render(
  <React.StrictMode>
    {/* <Provider store={store}> */}
      <BrowserRouter>
        <App />
      </BrowserRouter>
    {/* </Provider> */}
  </React.StrictMode>,
  document.querySelector('#root'));
