
import { makeStyles } from '@mui/material';
import { styled } from '@mui/material';
import * as createPalette from '@mui/material/styles/createPalette'
import { grey, purple } from '@mui/material/colors';

// declare module '@mui/material/styles/createPalette' {
//   interface PaletteOptions {
//     customColor1?: PaletteColorOptions;
//     customColor2?: PaletteColorOptions;
//   }
//   interface Palette {
//     customColor1: PaletteColor;
//     customColor2: PaletteColor;
//   }
// }
// export const useStyles = makeStyles((theme: any) => createStyles({
//   del: {
//     textDecoration: 'line- through 1px solid blue'
//   },
//   container: {
//     // backgroundColor: theme.palette.background.paper,
//     // padding: theme.spacing(4, 0, 3),//32px 24px 4:3 [1]=>8px
//     padding: theme.spacing(10, 4, 6)//64px 48px 4:3 [1]=>16px
//   }
// }));

// export const theme = createTheme({
//   palette: {
//     primary: {
//       main: '#556cd6',
//     },
//     secondary: {
//       main: '#19857b',
//     },
//     success: {
//       main: '#69A06F',
//     },
//     error: {
//       main: 'red',
//     },
//     customColor1: {
//       main: '#69cc6F',
//     },
//     customColor2: {
//       main: '#356cd6',
//     }
//   },
// });
export const classes:any = {
  buttonBack: {
    bgColor: grey[500],
  },
  iconButtonEdit: {
    '&:hover': {
      color: purple[300],
    }
  },
  iconButtonDelete: {
    '&:hover': {
      color: purple[300],
    }
  },
};
// export const useStyles: any = makeStyles(() => ({
//   buttonBack: {
//     bgColor: grey[500],
//   },
//   iconButtonEdit: {
//     '&:hover': {
//       color: purple[300],
//     }
//   },
//   iconButtonDelete: {
//     '&:hover': {
//       color: purple[300],
//     }
//   },
// }));
export const modalStyle = {
  position: 'absolute' as 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 400,
  bgcolor: 'background.paper',
  border: '2px solid #000',
  boxShadow: 24,
  p: 4,
  overflow: 'scroll',
  height: '100%',
  mt: 2,
  display: 'block'
}
