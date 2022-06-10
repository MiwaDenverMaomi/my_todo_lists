import React from 'react'
import { Card, CardContent, CardActions, Typography, TextField, Grid, FormGroup, Box, Container, FormControlLabel, Switch, Button, Link } from '@mui/material';

const Login = () => {
  return (
    <Box sx={{ marginBottom: 4 }} component="main">
      <Container maxWidth="xs" sx={{ paddingTop: 10, paddingRight: 4, paddingLeft: 4, paddingBottom: 6 }}>
        <Typography variant="h5" align="center" color="textPrimary" gutterBottom>
          Login
        </Typography>
        <Box sx={{ marginBottom: 1 }}>
          <Box sx={{ marginBottom: 1 }}>
            <TextField id="outlined-basic" label="Email" variant="outlined" margin="normal" name="email" required fullWidth autoFocus />
            <TextField id="outlined-basic" type="password" label="Password" variant="outlined" margin="normal" name="password" fullWidth required autoComplete="current-password" />
          </Box>
        </Box>
        <FormGroup sx={{ marginBottom: 4 }}>
          <FormControlLabel control={<Switch size="small" color="primary" />} label="Remember password"></FormControlLabel>
        </FormGroup>
        <Button variant="contained" type="submit" fullWidth color="primary">Log In</Button>
        <Grid container>
          <Grid item xs>
            <Link href="#">
              Forgot password?
            </Link>
          </Grid>
          <Grid item>
            <Link href="#" variant="body2">
              Create an account
            </Link>
          </Grid>
        </Grid>
      </Container>
    </Box>
  )
}

export default Login
