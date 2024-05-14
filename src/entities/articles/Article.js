/**
 * @property {string} author_name
 * @property {string} author_email
 * @property {string} title
 * @property {string} content
 * @property {string} created_at
 * @property {string} updated_at
 * @property {string} deleted_at
 */
export class Article {
  //   author_name
  //   author_email
  //   title
  //   content
  //   created_at
  //   updated_at
  //   deleted_at

  constructor(
    author_name = '',
    author_email = '',
    title = '',
    content = '',
    created_at = '',
    updated_at = '',
    deleted_at = '',
  ) {
    this.author_name = author_name
    this.author_email = author_email
    this.title = title
    this.content = content
    this.created_at = created_at
    this.updated_at = updated_at
    this.deleted_at = deleted_at
  }
}