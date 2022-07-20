import React from 'react';

import { Box, Button, Container, Typography, Grid } from '@mui/material';

// import { useStyles } from '../styles/styles';

const MyFavorite = () => {

  return (
    <Box sx={{ minHeight: '100vh' }} component="main">
      <Container sx={{ py: 8 }} maxWidth="md">
        <Typography variant="h5" color="textPrimary" align="center" gutterBottom>Favorite</Typography>
        <Container maxWidth="lg" sx={{ pt: 4, pb: 6 }}>
          <Typography variant="h6" color="textPrimary" align="center" gutterBottom>
            Are you done with your bucket list?
          </Typography>
        </Container>
      </Container >

    </Box >
  )
}

export default MyFavorite
