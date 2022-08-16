import React from 'react';
import { Grid, Modal, Box, Card, Typography, CardContent, CardMedia, List, ListItem, ListItemText, Avatar, Button, IconButton } from '@mui/material';
import { pink, grey } from '@mui/material/colors';
import FavoriteIcon from '@mui/icons-material/Favorite';
import { Data, UserData } from '../types/types';
import { modalStyle } from '../styles/styles';


type Props = {
  listModalOpen: boolean,
  listModalData: Data | null,
  handleProfileModalOpen: (userData: UserData) => void,
  profileModalOpen: boolean,
  handleClose: () => void
}
const ListModal = ({ listModalOpen, listModalData, handleClose, handleProfileModalOpen, profileModalOpen }: Props) => {
  const handleListModalCloseAndProfileModalOpen = (userData: UserData | undefined) => {
    handleClose();
    if (userData !== undefined) {
      handleProfileModalOpen(userData);
    }
  };
  return (
    <div>
      <Modal
        keepMounted
        open={listModalOpen}
        onClose={handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box sx={{ modalStyle }}>
          <Card sx={{ width: { "xs": '80%', "md": '30%' }, m: '30px auto', display: 'flex', flexDirection: 'column' }}>
            <Box>
              <CardMedia
                sx={{ maxWidth: '80%', pt: 2, pl: 2, pr: 2, pb: 0, m: '0 auto', display: 'flex', flexDirection: 'column' }}>
                <IconButton sx={{ m: '0 auto' }} onClick={() => handleListModalCloseAndProfileModalOpen(listModalData?.userData)}>
                  <Avatar src="https://picsum.photos/200/300" />
                </IconButton>
                <Typography variant="subtitle1" sx={{ textAlign: 'center', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{listModalData !== null && listModalData.userData.name !== '' ? listModalData.userData.name : 'No Name'}</Typography>
              </CardMedia>
              <Box sx={{ textAlign: 'center', pt: 3, display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                <IconButton>
                  <FavoriteIcon htmlColor={listModalData !== null && listModalData.userData.isGoodByAuth === true ? pink[200] : grey[500]} />
                </IconButton>
                <Typography variant="h5" sx={{ maxWidth: '60%', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{listModalData?.userData.good.toLocaleString()}</Typography>
              </Box>
            </Box>
            <CardContent sx={{ flexGrow: 1 }}>
              <List sx={{
                height: '250px',
                overflowY: 'scroll',
                pl: 2,
                listStyleType: 'disc',
                msOverFlowStyle: 'none',
                scrollBarWidth: 'none',
                '&::-webkit-scrollbar': {
                  display: 'none'
                }
              }}>
                {listModalData?.bucketListData.map((item, index) => (
                  <ListItem key={`${listModalData.userData.userId}_${item.id}_${item.description}`} sx={{ overflowWrap: 'break-word', display: 'list-item' }} disablePadding>
                    <ListItemText className={item.isDone ? 'del' : ''}>{item.description}</ListItemText>
                  </ListItem>
                ))}
              </List>
            </CardContent>
          </Card>
        </Box>
      </Modal>
    </div >
  );
}
export default ListModal;
