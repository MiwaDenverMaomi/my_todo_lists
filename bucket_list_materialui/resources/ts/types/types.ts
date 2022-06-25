//state
interface BucketListItem {
  id: string,
  description: string,
  isDone: boolean,
  updatedAt: string,
  createdAt: string
}

export type UserData = {
  userId: string,
  name?: string,
  photo: string,
  alt: string,
  comment: string,
  good: number,
  isGoodByAuth: boolean,
  notes?: {
    motto?: string,
    idealLife?: string,
    lottery?: string
  }
};

export type Data = {
  userData: UserData,
  bucketListData: BucketListItem[]
};

export type UserState = {
  users: UserData[],
  user:UserData
};

export type BucketListState = {
  allbucketLists: Data[],
  singleBucketList:Data
};

//actions
export type FetchAllBucketListsPayload = Data[];
export type fetchAllBucketLists = {
  type: 'string',
  payload: FetchAllBucketListsPayload
};

export type RootStates = UserState & BucketListState;

export type RootActions=FetchAllBucketListsPayload
