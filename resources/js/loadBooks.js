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
                                    <img src="${book.image}" id="bookCover">
                                </div>
                            </td>
                            <td>
                                ${book.title}
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
        }
        await send({ target: { value: "" } })
    }
})()

