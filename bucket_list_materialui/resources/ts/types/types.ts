interface bucketListItem {
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
}
export type Data = {
  userData: UserData,
  bucketListData: bucketListItem[]
}
