import React from 'react'
import { Card, CardMedia, CardContent, CardActions, Typography, TextField, IconButton, Box, List, Checkbox, Grid, ListItem, ListItemText, Container, FormControlLabel, Switch, Button, Link, Avatar } from '@mui/material';
import { green, pink } from '@mui/material/colors';
import { Data } from '../types/types';
import FavoriteIcon from '@mui/icons-material/Favorite';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';
import { classes } from '../styles/styles';

const myDummyData: Data = {
  userData: {
    userId: '1',
    name: '',
    photo: 'https://picsum.photos/200/300',
    alt: 'Aria',
    comment: 'abcdef',
    good: 5000,
    isGoodByAuth: false,
    notes: {
      motto: 'sssssssssssssssssssssssssssss',
      idealLife: 'aaaaaaaaaaaaaaaaaa',
      lottery: 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa'
    }

  },
  bucketListData: [
    {
      id: '1',
      description: 'xxssssssssssdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddssssssssssssssssssssssssssssssssssssssssssssssssssx',
      isDone: false,
      updatedAt: '2022/02/10',
      createdAt: '2022/02/10'
    },
    {
      id: '2',
      description: 'xxssssssssssssssssssssssssssssssssssssx',
      isDone: true,
      updatedAt: '2022/02/10',
      createdAt: '2022/02/10'
    },
    {
      id: '3',
      description: 'xxssssssssssssssssssssssssssssssssssssx',
      isDone: false,
      updatedAt: '2022/02/10',
      createdAt: '2022/02/10'
    }
    ,
    {
      id: '4',
      description: 'xxssssssssssssssssssssssssssssssssssssx',
      isDone: true,
      updatedAt: '2022/02/10',
      createdAt: '2022/02/10'
    }
  ]
}
const MyBucketList = () => {
  const myData: Data = myDummyData;
  // const classes = useStyles();
  return (
    <Box sx={{ marginBottom: 4 }} component="main">
      <Container maxWidth="sm" sx={{ paddingTop: 10, paddingRight: 4, paddingLeft: 4, paddingBottom: 6 }}>
        <Typography variant="h5" align="center" color="textPrimary" gutterBottom>
          My Bucket List
        </Typography>
        <Box>
          <Grid container spacing={0} direction="column" alignItems="center" justifyContent="center" sx={{ mb: 4 }}>
            <IconButton>
              <Avatar src={myData.userData.photo} />
            </IconButton>
            <Typography sx={{ mb: 1 }}>{myData.userData.name !== '' ? myData.userData.name : 'No Name'}</Typography>
            <Box sx={{ textAlign: 'center', display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
              <IconButton>
                <FavoriteIcon htmlColor={pink[200]} />
              </IconButton>
              <Typography variant="h5" sx={{ maxWidth: '60%', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>12</Typography>
            </Box>
          </Grid>
        </Box>
        <Box sx={{ marginBottom: 1 }}>
          <Box sx={{ marginBottom: 4 }}>
            <TextField id="outlined-basic" label="Write your wish" variant="standard" margin="normal" name="email" required fullWidth autoFocus />
          </Box>
        </Box>
        <Box>
          <Typography variant="body1" textAlign="center">{`You have ${myData.bucketListData.length} wishes to make happen!`}</Typography>
        </Box>
        <Grid sx={{ pt: 4, mb: 4 }}>
          {myData.bucketListData.length !== 0 ? myData.bucketListData.map(item =>
            <Card key={`${myData.userData.userId}_${item.id}`} sx={{ mb: 2, p: 1 }}>
              <Box sx={{ width: '100%', display: 'flex', justifyContent: 'space-between', p: 0 }}>
                <Checkbox sx={{ m: '0px', display: 'block', width: '40px', height: '40px' }} />
                <Typography variant="body1" sx={{ width: '90%', position: 'relative', top: 7, overflowWrap: 'break-word' }} >{item.description}
                </Typography>
              </Box>
              <Box sx={{ display: 'flex', justifyContent: 'flex-end' }}>
                <IconButton sx={{ width: '40px', height: '40px', pt: 0 }}>
                  <EditIcon className={classes.iconButtonEdit} />
                </IconButton>
                <IconButton sx={{ width: '40px', height: '40px', pt: 0 }}>
                  <DeleteIcon className={classes.iconButtonDelete} />
                </IconButton>
              </Box>
            </Card>
          ) : <Box><Typography variant="body1" textAlign="center">No Bucket List yet....</Typography></Box>}
        </Grid>

      </Container>
    </Box >
  )
}

export default MyBucketList
