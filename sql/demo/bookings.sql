\! echo "\033[32m*** ADD bookings ***\033[m";
INSERT INTO bookings (
        id,
        user_email,
        suites_id,
        date_checkin,
        date_checkout,
        price
    )
    VALUES(
        UUID(),
        (SELECT email FROM users WHERE email="jack@example.com"),
        (SELECT id FROM suites WHERE title="Eros"),
        "2022-03-20",
        "2022-03-22",
        55000
    )