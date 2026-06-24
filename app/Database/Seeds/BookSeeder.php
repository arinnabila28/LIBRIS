<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $books = [
            ['code_book'=>'BK001','isbn_book'=>'978-0-06-112008-4','title_book'=>'To Kill a Mockingbird','author_book'=>'Harper Lee','publisher_book'=>'J.B. Lippincott','published_year'=>1960,'description_book'=>'Novel klasik tentang keadilan dan rasisme di Amerika Selatan.','stock'=>5],
            ['code_book'=>'BK002','isbn_book'=>'978-0-7432-7356-5','title_book'=>'Harry Potter and the Sorcerer\'s Stone','author_book'=>'J.K. Rowling','publisher_book'=>'Bloomsbury','published_year'=>1997,'description_book'=>'Kisah seorang anak yatim yang menemukan dirinya adalah penyihir.','stock'=>8],
            ['code_book'=>'BK003','isbn_book'=>'978-0-7432-7357-2','title_book'=>'The Great Gatsby','author_book'=>'F. Scott Fitzgerald','publisher_book'=>'Scribner','published_year'=>1925,'description_book'=>'Kisah tentang kemewahan dan kehancuran di era Jazz Amerika.','stock'=>4],
            ['code_book'=>'BK004','isbn_book'=>'978-0-452-28423-4','title_book'=>'1984','author_book'=>'George Orwell','publisher_book'=>'Secker & Warburg','published_year'=>1949,'description_book'=>'Distopia tentang totalitarianisme dan pengawasan massal.','stock'=>6],
            ['code_book'=>'BK005','isbn_book'=>'978-0-316-76948-0','title_book'=>'The Catcher in the Rye','author_book'=>'J.D. Salinger','publisher_book'=>'Little, Brown','published_year'=>1951,'description_book'=>'Kisah remaja yang mencari jati diri di New York.','stock'=>3],
            ['code_book'=>'BK006','isbn_book'=>'978-0-14-028329-7','title_book'=>'Brave New World','author_book'=>'Aldous Huxley','publisher_book'=>'Chatto & Windus','published_year'=>1932,'description_book'=>'Gambaran dunia masa depan yang dikendalikan teknologi dan kesenangan.','stock'=>4],
            ['code_book'=>'BK007','isbn_book'=>'978-0-7434-8773-3','title_book'=>'The Lord of the Rings','author_book'=>'J.R.R. Tolkien','publisher_book'=>'Allen & Unwin','published_year'=>1954,'description_book'=>'Epik fantasi tentang perjalanan menghancurkan cincin kegelapan.','stock'=>5],
            ['code_book'=>'BK008','isbn_book'=>'978-0-06-093546-9','title_book'=>'To Kill a Mockingbird','author_book'=>'Harper Lee','publisher_book'=>'HarperCollins','published_year'=>2002,'description_book'=>'Edisi ulang tahun ke-40 novel klasik Harper Lee.','stock'=>2],
            ['code_book'=>'BK009','isbn_book'=>'978-0-14-303943-3','title_book'=>'Pride and Prejudice','author_book'=>'Jane Austen','publisher_book'=>'Penguin Classics','published_year'=>1813,'description_book'=>'Kisah cinta dan masyarakat di Inggris abad ke-19.','stock'=>6],
            ['code_book'=>'BK010','isbn_book'=>'978-0-7432-7358-9','title_book'=>'The Alchemist','author_book'=>'Paulo Coelho','publisher_book'=>'HarperOne','published_year'=>1988,'description_book'=>'Perjalanan seorang gembala muda mengejar mimpinya.','stock'=>7],
            ['code_book'=>'BK011','isbn_book'=>'978-0-385-33348-1','title_book'=>'The Da Vinci Code','author_book'=>'Dan Brown','publisher_book'=>'Doubleday','published_year'=>2003,'description_book'=>'Thriller tentang misteri seni dan agama di Eropa.','stock'=>4],
            ['code_book'=>'BK012','isbn_book'=>'978-0-525-55360-5','title_book'=>'Atomic Habits','author_book'=>'James Clear','publisher_book'=>'Avery','published_year'=>2018,'description_book'=>'Panduan membangun kebiasaan baik dan menghilangkan kebiasaan buruk.','stock'=>9],
            ['code_book'=>'BK013','isbn_book'=>'978-0-7432-7359-6','title_book'=>'Clean Code','author_book'=>'Robert C. Martin','publisher_book'=>'Prentice Hall','published_year'=>2008,'description_book'=>'Panduan menulis kode yang bersih dan mudah dipahami.','stock'=>5],
            ['code_book'=>'BK014','isbn_book'=>'978-0-201-63361-0','title_book'=>'Design Patterns','author_book'=>'Gang of Four','publisher_book'=>'Addison-Wesley','published_year'=>1994,'description_book'=>'Pola desain perangkat lunak yang telah teruji.','stock'=>3],
            ['code_book'=>'BK015','isbn_book'=>'978-979-756-853-6','title_book'=>'Laskar Pelangi','author_book'=>'Andrea Hirata','publisher_book'=>'Bentang Pustaka','published_year'=>2005,'description_book'=>'Kisah inspiratif anak-anak Belitung yang berjuang untuk pendidikan.','stock'=>8],
            ['code_book'=>'BK016','isbn_book'=>'978-979-756-999-1','title_book'=>'Bumi Manusia','author_book'=>'Pramoedya Ananta Toer','publisher_book'=>'Hasta Mitra','published_year'=>1980,'description_book'=>'Novel sejarah tentang perjuangan di era kolonial Belanda.','stock'=>4],
            ['code_book'=>'BK017','isbn_book'=>'978-602-8811-45-3','title_book'=>'Negeri 5 Menara','author_book'=>'Ahmad Fuadi','publisher_book'=>'Gramedia','published_year'=>2009,'description_book'=>'Kisah perjuangan santri di pesantren Gontor.','stock'=>6],
            ['code_book'=>'BK018','isbn_book'=>'978-0-7432-7360-2','title_book'=>'CodeIgniter 4 Handbook','author_book'=>'Dino Cajic','publisher_book'=>'Packt Publishing','published_year'=>2022,'description_book'=>'Panduan lengkap menggunakan framework CodeIgniter 4.','stock'=>5],
            ['code_book'=>'BK019','isbn_book'=>'978-0-13-235088-4','title_book'=>'The Pragmatic Programmer','author_book'=>'Andrew Hunt','publisher_book'=>'Addison-Wesley','published_year'=>1999,'description_book'=>'Panduan menjadi programmer yang lebih efektif dan profesional.','stock'=>4],
            ['code_book'=>'BK020','isbn_book'=>'978-0-13-468599-1','title_book'=>'Deep Work','author_book'=>'Cal Newport','publisher_book'=>'Grand Central Publishing','published_year'=>2016,'description_book'=>'Strategi fokus bekerja dalam era distraksi digital.','stock'=>5],
        ];

        foreach ($books as $book) {
            $this->db->table('books')->insert(array_merge($book, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
