import React from 'react';
import { BrowserRouter } from 'react-router-dom';
import  thunk from 'redux-thunk';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware,compose } from '@reduxjs/toolkit';
import ReactDOM from 'react-dom';
import './css/index.css';
import App from './App';
import reducers from './reducers';

interface ExtendedWindow extends Window {
  __REDUX_DEVTOOLS_EXTENSION_COMPOSE__?: typeof compose;
}

declare var window: ExtendedWindow;

const composeReduxDevToolsEnhancers = typeof window === 'object' && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

const middlewares = [thunk];


const store = createStore(
  reducers,
  composeReduxDevToolsEnhancers(applyMiddleware(...middlewares))
  // composeReduxDevToolsEnhancers(applyMiddleware(...middlewares))
);



ReactDOM.render(
  <React.StrictMode>
    <Provider store={store}>
      <BrowserRouter>
        <App />
      </BrowserRouter>
    </Provider>
  </React.StrictMode>,
  document.querySelector('#root'));
