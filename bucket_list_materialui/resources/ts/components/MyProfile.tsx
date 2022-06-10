import React from 'react'
import { styled } from '@mui/material';
import { Card, CardMedia, CardContent, CardActions, Typography, TextField, IconButton, Box, Container, FormControlLabel, Switch, Button, Link, Avatar } from '@mui/material';

const MyProfile = () => {
  return (
    <Box sx={{ marginBottom: 4 }} component="main">
      <Container maxWidth="sm" sx={{ paddingTop: 10, paddingRight: 4, paddingLeft: 4, paddingBottom: 6 }}>
        <Typography variant="h5" align="center" color="textPrimary" gutterBottom>
          Profile
        </Typography>
        <Card sx={{ pt: 4, mb: 4 }}>
          <IconButton sx={{ display: 'block', m: '0 auto' }}>
            <CardMedia
              component="img"
              height="200px"
              image="https://picsum.photos/200/300"
              alt="green iguana"
              sx={{ width: '200px', height: '200px', borderRadius: '50%', }}
            />
          </IconButton>
          <CardContent sx={{ pt: 4 }}>
            <Box sx={{ marginBottom: 1 }}>
              <TextField id="outlined-basic" label="Your Name" variant="outlined" margin="normal" name="email" sx={{ mb: 2 }} fullWidth autoFocus />
              <TextField
                id="outlined-multiline-flexible"
                label="What Is Your Motto?"
                multiline
                minRows={10}
                fullWidth
                sx={{ mb: 2 }}
              />
              <TextField
                id="outlined-multiline-flexible"
                label="What Is Your Ideal Life?"
                multiline
                minRows={10}
                fullWidth
                sx={{ mb: 2 }}
              />
              <TextField
                id="outlined-multiline-flexible"
                label="What Would You Do If You Win Lottery?"
                multiline
                minRows={10}
                fullWidth
                sx={{ mb: 2 }}
              />
            </Box>
          </CardContent>
        </Card>
        <Button variant="contained" type="submit" fullWidth color="primary">Log In</Button>
      </Container>
    </Box >
  )
}

export default MyProfile
