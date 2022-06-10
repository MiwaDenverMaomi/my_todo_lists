export interface Message {
  [key: string]: {
    title: string,
    statusCode: string,
    content?: string,
    href?: string,
  }
}

export const messages: Message =
{
  pageNotFound: {
    title: 'Page Not Found',
    statusCode: '404',
    content: 'The page could not be found...',
  },
};
