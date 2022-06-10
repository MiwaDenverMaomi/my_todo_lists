import React from 'react';

import { Card, CardMedia, Box, Button, Container, Typography, List, ListItem, ListItemText } from '@mui/material';

// import { useStyles } from '../styles/styles';

const Help = () => {

  return (
    <Box component="main" sx={{
      width: '100%',
    }} >
      <Card sx={{ width: '100%' }}>
        <CardMedia image="https://picsum.photos/800/1200" sx={{ m: { xs: 0, md: 2 } }}>
          <Container maxWidth="md" sx={{ py: 8, m: '0 auto' }} >
            <Typography component="h2" variant="h2" color="common.white" align="center" gutterBottom>Use "collective unconscious" to make your wishes true.</Typography>
            <Container sx={{ pt: 2, pb: 2 }}>
              <Typography component="h4" variant="h4" color="common.white" align="left" gutterBottom>
                The "collective unconscious" was advocated by the psychologist Jung.
              </Typography>
              <Typography component="h4" variant="h4" color="common.white" align="left" gutterBottom>
                In the "collective unconscious", there is enormous energy that can move all human beings, and if we can use this energy, we will be able to fulfill our wishes.
              </Typography>
              <Typography component="h6" variant="h6" color="common.white" align="left" gutterBottom>
                Make your bucket list and share it with other people. By getting known your wishes by other people, "collective unconscious" more likely to work to help your wishes come true.
              </Typography>
            </Container>
          </Container >
        </CardMedia>
      </Card>


    </Box >
  )
}

export default Help
