import * as prismic from '@prismicio/client';

/**
 * The project's Prismic repository name.
 */
export const repositoryName = import.meta.env.PUBLIC_PRISMIC_REPOSITORY || 'xadrezdasmarinas';

/**
 * Creates a Prismic client for the project's repository.
 * 
 * @param config - Configuration for the Prismic client.
 * @returns A Prismic client instance.
 */
export const createClient = (config: prismic.ClientConfig = {}) => {
  const client = prismic.createClient(repositoryName, {
    ...config,
  });

  return client;
};
