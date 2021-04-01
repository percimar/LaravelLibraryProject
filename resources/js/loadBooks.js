let categories = [
    'Fantasy',
    'Historical Fiction',
    'Autobiography',
    'Horror',
    'Detective Mystery',
    'Romance',
    'Thrillers'
];
(async () => {
    if (window.location.pathname === "/") {
        let searchField = document.getElementById('searchBooks')
        let listener = searchField.addEventListener('keydown', send)

        async function send(event) {

            let books = await $.get('/books', {
                data: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            })

            let loadTable = $('#loadBooks')
            loadTable.text('')

            books.map(book => {
                if (book.title.indexOf(event.target.value) !== -1) {
                    // Book CSS under append
                    loadTable.append(
                        `
                        <tr>
                            <td>
                                <div>
                                <a href = "/books/${book.id}">
                                    <img src="${book.image}" id="bookCover">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <a href = "/books/${book.id}">
                                    ${book.title}
                                </a>
                            </td>
                            <td>
                                ${book.author}
                            </td>
                            <td>
                                ${book.category}
                            </td>
                            <td>
                                 <a class="btn btn-primary" href="/books/${book.id}/reserve">Reserve</a>
                            </td>
                        </tr>
                        `
                    )
                }
            })


            let loadCat = $('#loadCategories');
            loadCat.text('')

            categories.map(category => {
                loadCat.append(
                    `
                <a href="#">
                    ${category}
                </a><br />
                    `
                )
            }
            )
        }
        await send({ target: { value: "" } })
    }
})()

