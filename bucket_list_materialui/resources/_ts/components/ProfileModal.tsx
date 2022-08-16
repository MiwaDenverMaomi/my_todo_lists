import React from 'react';
import { Modal, Box, Card, CardMedia, List, ListItem, ListItemText, Typography, CardContent } from '@mui/material';
import { modalStyle } from '../styles/styles';
import { Data, UserData } from '../types/types';
// import ProfileAccordion from './ProfileAccordion';

type Props = {
  profileModalOpen: boolean,
  profileModalData: UserData | null,
  handleClose: () => void
};

const ProfileModal = ({ profileModalOpen, handleClose, profileModalData }: Props) => {

  return (
    <div>
      <Modal
        keepMounted
        open={profileModalOpen}
        onClick={handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box sx={modalStyle}>
          <Card>
            <CardMedia
              component="img"
              height="200px"
              image="https://picsum.photos/200/300"
              alt="green iguana"
              sx={{ width: '200px', height: '200px', borderRadius: '50%', m: '0 auto', }}
            />
            <CardContent>
              <Typography gutterBottom variant="h5" component="div" textAlign="center" sx={{ overflowWrap: 'break-word' }}>
                {profileModalData !== null && profileModalData.name !== '' ? profileModalData.name : 'No Name'}
              </Typography>
              <Typography gutterBottom variant="h6" component="div">What is your motto?</Typography>
              <Typography variant="body2" color="text.secondary" sx={{ mb: 2 }}>
                {profileModalData !== null && profileModalData.notes !== undefined ? profileModalData.notes.motto : 'None'}
              </Typography>
              <Typography gutterBottom variant="h6" component="div">What is your ideal life?</Typography>
              <Typography variant="body2" color="text.secondary" sx={{ mb: 2 }}>
                {profileModalData !== null && profileModalData.notes !== undefined ? profileModalData.notes.idealLife : 'None'}
              </Typography>
              <Typography gutterBottom variant="h6" component="div" >What do you want to do if you win the lottery?</Typography>
              <Typography variant="body2" color="text.secondary" sx={{ mb: 2 }}>
                {profileModalData !== null && profileModalData.notes !== undefined ? profileModalData.notes.lottery : 'None'}
              </Typography>
            </CardContent>
          </Card>
        </Box>
      </Modal>
    </div>
  )
}

export default ProfileModal
