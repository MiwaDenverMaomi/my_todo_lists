import React from 'react'
import { Container, Typography, Box, TextField, Button } from '@mui/material';
// import { useStyles } from '../styles/styles';

const PasswordReset = () => {
  // const classes = useStyles();
  return (
    <Box sx={{ marginBottom: 4 }}>
      <Container maxWidth="xs" sx={{ paddingTop: 10, paddingRight: 4, paddingLeft: 4, paddingBottom: 6 }}>
        <Typography variant="h5" align="center" color="textPrimary" gutterBottom>
          Password Reset
        </Typography>
        <Box sx={{ marginBottom: 1 }}>
          <Box sx={{ marginBottom: 1 }}>
            <TextField variant="outlined" margin="normal" name="email" label="Email" required fullWidth autoFocus></TextField>
          </Box>
        </Box>
        <Button variant="contained" type="submit" fullWidth color="primary">Send</Button>
      </Container>
    </Box>
  )
}

export default PasswordReset
