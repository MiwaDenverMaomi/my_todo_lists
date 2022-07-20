import React,{useEffect} from 'react';
import { connect } from 'react-redux';
import { Dispatch,Action } from 'redux';
import { ThunkDispatch} from 'redux-thunk';
import { Box, Container, Grid, Typography, Card, CardContent, CardMedia, Avatar, List, ListItem, Checkbox, ListItemText, CardActions, Button, IconButton, formLabelClasses, styled, alpha, Modal } from '@mui/material';
import FavoriteIcon from '@mui/icons-material/Favorite';
import { pink, grey } from '@mui/material/colors';
import ListModal from './ListModal';
import { Data, UserData } from '../types/types';
import ProfileModal from './ProfileModal';
import { RootStates, RootActions } from '../types/types';
import { fetchAllBucketLists} from '../actions/BucketListActions'



const AllBucketLists = ({fetchAllBucketLists,allBucketLists}:Props) => {
  // const data: Data[] = [
  //   {
  //     userData: {
  //       userId: '1',
  //       name: '',
  //       photo: '#',
  //       alt: 'Aria',
  //       comment: 'abcdef',
  //       good: 5000,
  //       isGoodByAuth: false,
  //       notes: {
  //         motto: 'sssssssssssssssssssssssssssss',
  //         idealLife: 'aaaaaaaaaaaaaaaaaa',
  //         lottery: 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa'
  //       }

  //     },
  //     bucketListData: [
  //       {
  //         id: '1',
  //         description: 'xxssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssx',
  //         isDone: false,
  //         updatedAt: '2022/02/10',
  //         createdAt: '2022/02/10'
  //       },
  //       {
  //         id: '2',
  //         description: 'xxssssssssssssssssssssssssssssssssssssx',
  //         isDone: true,
  //         updatedAt: '2022/02/10',
  //         createdAt: '2022/02/10'
  //       },
  //       {
  //         id: '3',
  //         description: 'xxssssssssssssssssssssssssssssssssssssx',
  //         isDone: false,
  //         updatedAt: '2022/02/10',
  //         createdAt: '2022/02/10'
  //       }
  //       ,
  //       {
  //         id: '4',
  //         description: 'xxssssssssssssssssssssssssssssssssssssx',
  //         isDone: true,
  //         updatedAt: '2022/02/10',
  //         createdAt: '2022/02/10'
  //       }
  //     ]
  //   },
  //   {
  //     userData: {
  //       userId: '2',
  //       name: 'Aika',
  //       photo: '#',
  //       alt: 'Aria',
  //       comment: 'abcdef',
  //       good: 5000,
  //       isGoodByAuth: true,
  //     },
  //     bucketListData: [{
  //       id: '2',
  //       description: 'xxx',
  //       isDone: true,
  //       updatedAt: '2022/02/10',
  //       createdAt: '2022/02/10'
  //     }]
  //   },
  //   {
  //     userData: {
  //       userId: '3',
  //       name: 'Akari',
  //       photo: '#',
  //       alt: 'Aria',
  //       comment: 'abcdef',
  //       good: 5000,
  //       isGoodByAuth: false,
  //     },
  //     bucketListData: [{
  //       id: '3',
  //       description: 'xxx',
  //       isDone: true,
  //       updatedAt: '2022/02/10',
  //       createdAt: '2022/02/10'
  //     }]
  //   },
  //   {
  //     userData: {
  //       userId: '4',
  //       name: 'Akatsuki',
  //       photo: '#',
  //       alt: 'Akatsuki',
  //       comment: 'abcdef',
  //       good: 5000,
  //       isGoodByAuth: false,
  //     },
  //     bucketListData: [
  //       {
  //         id: '4',
  //         description: 'xxx',
  //         isDone: true,
  //         updatedAt: '2022/02/10',
  //         createdAt: '2022/02/10'
  //       },
  //       {
  //         id: '5',
  //         description: 'xxx',
  //         isDone: true,
  //         updatedAt: '2022/02/10',
  //         createdAt: '2022/02/10'
  //       }]
  //   }
  // ];
  const [listModalOpen, setListModalOpen] = React.useState<boolean>(false);
  const [listModalData, setListModalData] = React.useState<Data | null>(null);
  const [profileModalOpen, setProfileModalOpen] = React.useState<boolean>(false);
  const [profileModalData, setProfileModalData] = React.useState<UserData | null>(null);
  const handleListModalOpen = (item: Data) => {
    setListModalOpen(true);
    setListModalData(item);
  };
  const handleProfileModalOpen = (item: UserData) => {
    console.log('handleProfileModalOpen');
    setProfileModalOpen(true);
    setProfileModalData(item);
  };

  const handleClose = () => {
    if (listModalOpen) {
      setListModalOpen(false);
    }
    if (profileModalOpen) {
      setProfileModalOpen(false);
    }
  }
  useEffect(() => {
    console.log('useEffect');
    fetchAllBucketLists();
  });
  return (
    <Box sx={{ minHeight: '100vh' }}>
      <ListModal
        listModalOpen={listModalOpen}
        listModalData={listModalData}
        handleProfileModalOpen={handleProfileModalOpen}
        profileModalOpen={profileModalOpen}
        handleClose={handleClose} />
      <ProfileModal
        profileModalOpen={profileModalOpen}
        handleClose={handleClose}
        profileModalData={profileModalData} />
      <Container sx={{ py: 8 }} maxWidth="md">
        <Typography variant="h5" color="textPrimary" align="center" gutterBottom>All Bucket Lists</Typography>
        <Box sx={{ marginBottom: 1 }}>
          <Grid container spacing={4}>
            {allBucketLists.map((item:Data, index:number) => (
              <Grid item key={item.userData.userId} xs={12} sm={6} md={4}>
                <Card sx={{ height: '100%', display: 'flex', flexDirection: 'column' }}>
                  <Box  >
                    <Box sx={{ textAlign: 'center', paddingTop: 3, display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                      <FavoriteIcon htmlColor={item.userData.isGoodByAuth ? pink[200] : grey[500]} />
                      <Typography variant="h5" sx={{ maxWidth: '60%', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }} >{item.userData.good.toLocaleString()}</Typography>
                    </Box>
                  </Box>
                  <CardContent sx={{ flexGrow: 1 }}>
                    <List sx={{
                      height: '150px',
                      overflow: 'hidden',
                      paddingLeft: 2,
                      listStyleType: 'disc'
                    }}>
                      {item.bucketListData.map((item, index) => (
                        <ListItem key={`${item.id}_${item.description}`} sx={{ overflowWrap: 'break-word', display: 'list-item' }} disablePadding>
                          <ListItemText >{item.description}</ListItemText>
                        </ListItem>
                      ))}
                    </List>
                  </CardContent>
                  <CardActions sx={{ display: 'flex', justifyContent: 'space-between' }}>
                    <Button size="small" onClick={() => handleListModalOpen(item)} >See More</Button>
                    <IconButton onClick={() => handleProfileModalOpen(item.userData)}>
                      <Avatar src="https://picsum.photos/200/300" />
                    </IconButton>
                  </CardActions>
                </Card>
              </Grid>
            ))}
          </Grid>
        </Box>

      </Container >

    </Box >

  )
}
type DispatchToProps =any
type MapStateToProps = {
  allBucketLists:Data[]
}
type mapDispatchToProps = {
  fetchAllBucketLists: ThunkDispatch<Data[],undefined,Action<string>>
}
type Props = MapStateToProps & DispatchToProps;

const mapDispatchToProps = (dispatch: ThunkDispatch<any, any, any>) => {
  return {
    fetchAllBucketLists: dispatch(fetchAllBucketLists())
  };

};

const mapStateToProps = (state: RootStates) => {
  return {
    allBucketLists: state.allBucketLists
  };

};

export default connect(mapStateToProps, mapDispatchToProps)(AllBucketLists);
