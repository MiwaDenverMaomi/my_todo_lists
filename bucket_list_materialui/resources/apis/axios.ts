import Axios from 'axios';

const axios = Axios.create({
  baseURL: 'https://www.share-my-todo-list.com',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  // withCredentials: true
  responseType: 'json'
});

export default axios;
