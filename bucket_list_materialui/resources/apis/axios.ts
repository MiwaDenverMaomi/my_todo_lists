import Axios from 'axios';

const axios = Axios.create({
  baseURL: '/localhost',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application / json',
    'Content-Type': 'application/json'
  },
  withCredentials: true
});

export default axios;
