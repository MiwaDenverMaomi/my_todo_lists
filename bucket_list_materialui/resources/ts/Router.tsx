import React from 'react'
import { Route, Routes, Navigate } from 'react-router-dom';
import Login from './components/Login';
import PasswordSet from './components/PasswordSet';
import PasswordReset from './components/PasswordReset';
import Footer from './components/Footer';
import AllBucketLists from './components/AllBucketLists';
import Cancel from './components/Cancel';
import Help from './components/Help';
import ContactUs from './components/ContactUs';
import MyProfile from './components/MyProfile';
import MyBucketList from './components/MyBucketList';
import MenuBar from './components/MenuBar';
import MyFavorite from './components/MyFavorite';
import Notification from './components/Notification';
import { messages } from './consts/messages';

const Router = () => {
  console.log('router');
  const isLogin = false;//Reduxアクセスし、直接authのログインステータスを取得する。
  return (
    <Routes>
      <Route path="/" element={<AllBucketLists />}></Route>
      <Route path="/login" element={isLogin ? <Navigate to={"/"} /> : <Login />}></Route>
      <Route path="user/my-bucket-list" element={isLogin ? <MyBucketList /> : <Navigate to={"/"} />}></Route>
      <Route path="user/my-favorite" element={isLogin ? <MyFavorite /> : <Navigate to={"/"} />}></Route>
      <Route path="user/my-profile" element={isLogin ? <MyProfile /> : <Navigate to={"/"} />}></Route>
      <Route path="user/password-reset" element={isLogin ? <PasswordReset /> : <Navigate to={"/"} />}></Route>
      <Route path="user/cancel" element={isLogin ? <Cancel /> : <Navigate to={"/"} />}></Route>
      <Route path="/contact-us" element={<ContactUs />}></Route>
      <Route path="/about-this-app" element={<Help />}></Route>
      <Route path="*" element={<Notification message={messages.pageNotFound} />}></Route>
    </Routes>
  )
};

export default Router;
