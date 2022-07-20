import React from 'react';
import { Box, Button, Container, Typography, Grid } from '@mui/material';

// import { useStyles } from '../styles/styles';
import { messages, Message } from '../consts/messages';

const Notification = ({ message }: Message) => {

  return (
    <Box sx={{ minHeight: '100vh' }} component="main">
      <Container sx={{ py: 8 }} maxWidth="md">
        <Typography variant="h5" color="textPrimary" align="center" gutterBottom>{message.title}</Typography>
        <Container maxWidth="sm" sx={{ pt: 4, pb: 6 }}>
          <Typography variant="h6" color="textPrimary" align="center" gutterBottom>
            {message.content}
          </Typography>
        </Container>
        <Box sx={{ width: '45%', m: '0 auto', display: 'flex', justifyContent: 'center', flexDirection: { xs: 'column', md: 'row' }, alignItems: { xs: 'center' } }}>
          <Button sx={{ m: '0 auto 10px' }} >&gt; Go Back</Button>
        </Box>
      </Container >
    </Box >
  )
}

export default Notification
