import React from 'react';

import { Box, Button, Container, Typography, Grid } from '@mui/material';

// import { useStyles } from '../styles/styles';

const Cancel = () => {

  return (
    <Box sx={{ minHeight: '100vh' }} component="main">
      <Container sx={{ py: 8 }} maxWidth="md">
        <Typography variant="h5" color="textPrimary" align="center" gutterBottom>Cancel</Typography>
        <Container maxWidth="sm" sx={{ pt: 4, pb: 6 }}>
          <Typography variant="h6" color="textPrimary" align="center" gutterBottom>
            Are you done with your bucket list?
          </Typography>
        </Container>
        <Box sx={{ width: '45%', m: '0 auto', display: 'flex', justifyContent: 'space-between', flexDirection: { xs: 'column', md: 'row' }, alignItems: { xs: 'center' } }}>
          <Button variant="contained" color="primary" sx={{ m: '0 auto 10px' }}>Yes, cancel my account</Button>
          <Button sx={{ m: '0 auto 10px' }} >&gt; Go Back</Button>
        </Box>
      </Container >

    </Box >
  )
}

export default Cancel
