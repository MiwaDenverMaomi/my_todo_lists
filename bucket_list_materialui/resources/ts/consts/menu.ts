import React from 'react';
import { SvgIconProps } from '@mui/material';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import FaceIcon from '@mui/icons-material/Face';
import FolderSpecialIcon from '@mui/icons-material/FolderSpecial';
import DirectionsRunIcon from '@mui/icons-material/DirectionsRun';
import LockIcon from '@mui/icons-material/Lock';
import LogoutIcon from '@mui/icons-material/Logout';
import LoginIcon from '@mui/icons-material/Login';
import AppsIcon from '@mui/icons-material/Apps';

export interface Menu {
  name: string,
  href: string,
  icon?: any
}

export const userMenu: Menu[] = [
  {
    name: 'Top',
    href: '/',
    icon: AppsIcon
  },
  {
    name: 'My Bucket List',
    href: '/user/my-bucket-list',
    icon: FormatListNumberedIcon
  },
  {
    name: 'My Profile',
    href: '/user/my-profile',
    icon: FaceIcon
  },
  {
    name: 'My Favofite',
    href: '/user/my-favorite',
    icon: FolderSpecialIcon,
  },
  {
    name: 'Password Reset',
    href: '/user/password-reset',
    icon: LockIcon,
  },
  {
    name: 'Cancel',
    href: '/user/cancel',
    icon: DirectionsRunIcon,

  },
  {
    name: 'Logout',
    href: '/user/logout',
    icon: LogoutIcon,
  }
];
export const generalMenu: Menu[] = [

  {
    name: "Contact Us",
    href: "/contact-us",
    icon: LoginIcon,
  },
  {
    name: "About This App",
    href: "/about-this-app",
    icon: LoginIcon,
  }
];

export const nonUserMenu: Menu[] = [
  {
    name: 'Top',
    href: '/',
    icon: AppsIcon
  },
  {
    name: "Login",
    href: "/login",
    icon: LoginIcon
  }
];

export const footerMenu: Menu[] = [
  {
    name: "Privacy Policy",
    href: "#",
  },

  {
    name: "Terms of Service",
    href: "#"
  },
  {
    name: "About Us",
    href: "#"
  },
  {
    name: "Contact",
    href: "#"
  }
];
export const websiteName = 'Bucket List';
