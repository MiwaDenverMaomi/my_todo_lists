import React from 'react';
import { Link } from 'react-router-dom';
import { useState } from 'react';
import { Toolbar, Divider, List, ListItem, ListItemButton, ListItemText, ListItemIcon, Avatar, Tooltip, IconButton } from '@mui/material';
import InboxIcon from '@mui/icons-material/Inbox';
import MailIcon from '@mui/icons-material/Mail';

import { userMenu, nonUserMenu, generalMenu } from '../consts/menu';

const DrawerItem = () => {
  const isLogin = false;//Reduxアクセスし、直接authのログインステータスを取得する。
  const menu = isLogin ? userMenu : nonUserMenu;

  return (
    <div>
      <Toolbar>
        <Tooltip title="avator" sx={{ margin: '0 auto' }}>
          <IconButton>
            <Avatar alt="Remy Sharp" src="/static/images/avatar/1.jpg" />
          </IconButton>
        </Tooltip>
      </Toolbar>
      <Divider />
      <List>
        {menu.map((item, index) => (
          <ListItem key={`${item}_${index}`} disablePadding>
            <Link to={item.href}>
              <ListItemButton>
                {item.icon ? <ListItemIcon>{<item.icon />}</ListItemIcon> : ''}
                <ListItemText primary={item.name}></ListItemText>
              </ListItemButton>
            </Link>
          </ListItem>
        ))}
      </List>
      <Divider />
      <List>
        {generalMenu.map((item, index) => (
          <Link to={item.href}>
            <ListItem key={`${item}_${index}`} disablePadding>
              <ListItemButton>
                <ListItemText primary={item.name}></ListItemText>
              </ListItemButton>
            </ListItem>
          </Link>
        ))}
      </List>
    </div>
  )
}

export default DrawerItem
