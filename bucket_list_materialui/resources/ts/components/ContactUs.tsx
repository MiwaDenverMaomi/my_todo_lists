import React from 'react';

import { Typography, TextField, FormGroup, Box, Container, Button, TextareaAutosize } from '@mui/material';

// import { useStyles } from '../styles/styles';

const ContactUs = () => {

  return (
    <Box sx={{ marginBottom: 4 }} component="main">
      <Container maxWidth="xs" sx={{ paddingTop: 10, paddingRight: 4, paddingLeft: 4, paddingBottom: 6 }}>
        <Typography variant="h5" align="center" color="textPrimary" gutterBottom>
          Contact Us
        </Typography>
        <Container sx={{ pt: 4, pb: 2 }}>
          <Typography variant="h6" color="textPrimary" align="center" gutterBottom>
            Let us know your questions / comments!!
          </Typography>
        </Container>
        <Box sx={{ marginBottom: 1 }}>
          <Box sx={{ marginBottom: 1 }}>
            <TextField id="outlined-basic" label="Email" variant="outlined" margin="normal" name="email" required fullWidth autoFocus />
            <TextField id="outlined-basic" label="Name" variant="outlined" margin="normal" name="name" fullWidth required />
            <TextField id="outlined-basic" label="Title" variant="outlined" margin="normal" name="title" fullWidth required sx={{ mb: 3 }} />
            <TextField
              id="outlined-multiline-flexible"
              label="Comment"
              multiline
              required
              minRows={10}
              fullWidth
            />
          </Box>
        </Box>
        <FormGroup sx={{ marginBottom: 4 }}>
        </FormGroup>
        <Button variant="contained" type="submit" fullWidth color="primary">Submit</Button>
      </Container>
    </Box>
  )
}

export default ContactUs
