import React from 'react';
import axios from '../../apis/axios';
import { Dispatch, Action, ActionCreator, } from 'redux';
import { ThunkAction,ThunkDispatch } from 'redux-thunk';
import { AxiosResponse,AxiosError } from 'axios';
// import { UserData, Data,RootStates,RootActions } from '../types/types';

// export const fetchAllBucketLists = ():ThunkAction<void,RootStates,undefined,RootActions> =>async(dispatch:Dispatch)=> {
//   const response = await axios.get('/').then(res => res);
//   dispatch({ type: 'FETCH_ALL_BUCKET_LISTS', payload:response.data});
//   };
