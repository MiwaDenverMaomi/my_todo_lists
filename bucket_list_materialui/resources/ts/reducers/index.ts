import { combineReducers } from 'redux';
import { bucketListReducer } from '../reducers/BucketListReducer';
export default combineReducers({
  allBucketLists:bucketListReducer
});
