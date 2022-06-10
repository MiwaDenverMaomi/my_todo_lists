import React from 'react'
import { Container, Typography, Box, Link, Grid, styled, alpha } from '@mui/material';
import { footerMenu, websiteName } from '../consts/menu';
const Footer = () => {
  const StyledLink = styled(Link)(({ theme }) => ({
    display: 'block',
    textDecoration: 'none',
    color: theme.palette.common.white,
    borderRadius: theme.shape.borderRadius,
    '&:hover': {
      backgroundColor: alpha(theme.palette.common.white, 0.15)
    }
  }));
  return (
    <Box component="footer" sx={{
      backgroundColor: 'primary.main', flexGrow: 1,
      width: '100%'
    }}>
      <Container maxWidth="lg" sx={{ paddingTop: 2, paddingBottom: 2 }}>
        <Grid container mb={1} sx={{ justifyContent: 'center', alignItems: 'center' }}>
          {footerMenu.map((menu, key) => (
            <Grid item xs={12} sm={4} md={1.5} key={`footer_button_${key}`}>
              <Box sx={{ textAlign: 'center', padding: 1 }}>
                <StyledLink href={menu.href} color="inherit">
                  {menu.name}
                </StyledLink>
              </Box>
            </Grid>
          ))}
        </Grid>
        <Typography variant="body2" sx={{ textAlign: 'center', color: 'common.white' }}>
          Copyright © {' '}
          <StyledLink sx={{ display: 'inline' }} color="inherit" href="#">
            {websiteName}
          </StyledLink>
          {' '}All Rights Reserved.
          {new Date().getFullYear()}{'.'}
        </Typography>
      </Container>
    </Box>
  )
}

export default Footer
