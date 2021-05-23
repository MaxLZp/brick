SELECT books.id, books.title FROM `books`
INNER JOIN book_authors ON books.id = book_authors.book_id
GROUP BY book_authors.book_id
HAVING COUNT(book_authors.author_id) = 3