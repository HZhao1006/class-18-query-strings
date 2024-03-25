-- database: ../test.sqlite
--
--- Flower Sample Requests ---
CREATE TABLE flower_samples (
  id INTEGER NOT NULL UNIQUE,
  business_name TEXT NOT NULL,
  phone TEXT NOT NULL,
  sample_type INTEGER NOT NULL,
  PRIMARY KEY (id AUTOINCREMENT)
);

INSERT INTO
  flower_samples (id, business_name, phone, sample_type)
VALUES
  (0, '2300 Zoo', '607-555-2424', '1');

INSERT INTO
  flower_samples (id, business_name, phone, sample_type)
VALUES
  (1, '2300 Cafe', '607-555-8080', '3');

INSERT INTO
  flower_samples (id, business_name, phone, sample_type)
VALUES
  (2, '2300 Tax Prep', '607-555-1111', '2');

--- Courses ---
CREATE TABLE courses (
  id INTEGER NOT NULL UNIQUE,
  number TEXT NOT NULL,
  title TEXT NOT NULL,
  credits INTEGER NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    4010,
    'CS 1110',
    'Introduction to Computing Using Python',
    4
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    5001,
    'INFO 1200',
    'Information Ethics, Law, and Policy',
    3
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    5020,
    'INFO 1300',
    'Introductory Design and Programming for the Web',
    4
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (5041, 'INFO 2040', 'Networks', 4);

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    5045,
    'INFO 2300',
    'Intermediate Design and Programming for the Web',
    4
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    5052,
    'INFO 2450',
    'Communication and Technology',
    3
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    5068,
    'INFO 2950',
    'Introduction to Data Science',
    4
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    5073,
    'INFO 3300',
    'Data-Driven Web Applications',
    3
  );

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (7101, 'MATH 1110', 'Calculus I', 4);

INSERT INTO
  courses (id, number, title, credits)
VALUES
  (
    7120,
    'MATH 1710',
    'Statistical Theory and Application in the Real World',
    4
  );

--- Transcript Grades ---
CREATE TABLE grades (
  id INTEGER NOT NULL UNIQUE,
  course_id INTEGER NOT NULL,
  term INTEGER NOT NULL,
  acad_year INTEGER NOT NULL,
  grade TEXT,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY (course_id) REFERENCES courses(id)
);

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (1, 5001, 101, 1, 'A-');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (2, 5020, 101, 1, 'A');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (3, 7101, 102, 1, 'A+');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (4, 7120, 102, 1, 'C');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (5, 5052, 103, 2, 'B');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (6, 5068, 103, 2, 'F');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (7, 5041, 104, 2, 'A+');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (8, 5045, 104, 2, 'B+');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (9, 5073, 105, 3, 'A');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (10, 5068, 105, 3, 'A');

INSERT INTO
  grades (id, course_id, term, acad_year, grade)
VALUES
  (11, 4010, 106, 3, NULL);

--- Products ---
CREATE TABLE products (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL,
  price REAL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  products (id, name, price)
VALUES
  (1, 'Flyknit', 59.99);

INSERT INTO
  products (id, name, price)
VALUES
  (2, 'Air Zoom', 119.99);

INSERT INTO
  products (id, name, price)
VALUES
  (3, 'Roshe', 39.99);

INSERT INTO
  products (id, name, price)
VALUES
  (4, 'Lunar Guide', 59.99);

INSERT INTO
  products (id, name, price)
VALUES
  (5, 'Airforce', 79.99);

--- Reviews ---
CREATE TABLE reviews (
  id INTEGER NOT NULL UNIQUE,
  reviewer TEXT NOT NULL,
  rating INTEGER NOT NULL,
  product_id TEXT NOT NULL,
  comment TEXT,
  created_at TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    1,
    'js8282@cornell.edu',
    3,
    1,
    'These run smaller.',
    '2017-05-11 08:56:21'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    2,
    'jd1234@cornell.edu',
    4,
    1,
    'These are so comfy they don''t even feel like shoes!',
    '2018-09-05 14:45:51'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    3,
    'alm119@cornell.edu',
    4,
    2,
    NULL,
    '2019-09-05 00:09:54'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    4,
    'ppl33@cornell.edu',
    3,
    3,
    'Nice.',
    '2019-08-14 01:21:08'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    5,
    'lol88@cornell.edu',
    2,
    1,
    'Not a fan. They seem kind of flimsy.',
    '2017-09-29 07:12:28'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    6,
    'sos111@cornell.edu',
    3,
    4,
    'Solid shoe.',
    '2019-12-08 11:53:06'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    7,
    'heh101@cornell.edu',
    5,
    5,
    'Will buy again! Recommending to all my friends!',
    '2018-09-27 13:07:08'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    8,
    'dj1004@cornell.edu',
    1,
    3,
    NULL,
    '2018-01-20 22:41:00'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    9,
    'hmm21@cornell.edu',
    5,
    5,
    'Got mine last week and I loved them! Just ordered my second pair!',
    '2019-07-22 19:03:00'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    10,
    'kid14@cornell.edu',
    3,
    3,
    'Not sure how I feel about these but they''re alright.',
    '2017-12-06 02:13:59'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    11,
    'man12@cornell.edu',
    4,
    3,
    'It came faster than expected!',
    '2019-12-29 06:23:00'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    12,
    'wat11@cornell.edu',
    4,
    2,
    'The color was just as pretty in the photo!',
    '2019-02-10 13:49:26'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    13,
    'apo96@cornell.edu',
    4,
    4,
    'I got these for my son and he loved them! Just make sure you check the size, I don''t know if these run big but I had to go back and exchange it for half a size smaller',
    '2019-03-16 02:07:09'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    14,
    'brb9@cornell.edu',
    4,
    4,
    'Sweet kicks.',
    '2020-08-12 00:46:28'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    15,
    'kk34@cornell.edu',
    3,
    1,
    NULL,
    '2019-03-17 07:27:04'
  );

INSERT INTO
  reviews (
    id,
    reviewer,
    rating,
    product_id,
    comment,
    created_at
  )
VALUES
  (
    16,
    'jam39@cornell.edu',
    1,
    4,
    'I expected to feel like I was walking on the moon. But it felt like I was walking on nails instead. I would give 0 stars if I could!',
    '2021-03-31 15:00:51'
  );
