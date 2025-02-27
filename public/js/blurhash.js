const blurhash = (function (t) {
    const e = [
            "0",
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "A",
            "B",
            "C",
            "D",
            "E",
            "F",
            "G",
            "H",
            "I",
            "J",
            "K",
            "L",
            "M",
            "N",
            "O",
            "P",
            "Q",
            "R",
            "S",
            "T",
            "U",
            "V",
            "W",
            "X",
            "Y",
            "Z",
            "a",
            "b",
            "c",
            "d",
            "e",
            "f",
            "g",
            "h",
            "i",
            "j",
            "k",
            "l",
            "m",
            "n",
            "o",
            "p",
            "q",
            "r",
            "s",
            "t",
            "u",
            "v",
            "w",
            "x",
            "y",
            "z",
            "#",
            "$",
            "%",
            "*",
            "+",
            ",",
            "-",
            ".",
            ":",
            ";",
            "=",
            "?",
            "@",
            "[",
            "]",
            "^",
            "_",
            "{",
            "|",
            "}",
            "~",
        ],
        a = (t) => {
            let a = 0;
            for (let r = 0; r < t.length; r++) {
                const o = t[r];
                a = 83 * a + e.indexOf(o);
            }
            return a;
        },
        r = (t, a) => {
            var r = "";
            for (let o = 1; o <= a; o++) {
                let h = (Math.floor(t) / Math.pow(83, a - o)) % 83;
                r += e[Math.floor(h)];
            }
            return r;
        },
        o = (t) => {
            let e = t / 255;
            return e <= 0.04045
                ? e / 12.92
                : Math.pow((e + 0.055) / 1.055, 2.4);
        },
        h = (t) => {
            let e = Math.max(0, Math.min(1, t));
            return e <= 0.0031308
                ? Math.round(12.92 * e * 255 + 0.5)
                : Math.round(
                      255 * (1.055 * Math.pow(e, 1 / 2.4) - 0.055) + 0.5
                  );
        },
        n = (t, e) => ((t) => (t < 0 ? -1 : 1))(t) * Math.pow(Math.abs(t), e),
        l = (t) => {
            if (!t || t.length < 6)
                throw new Error(
                    "The blurhash string must be at least 6 characters"
                );
            const e = a(t[0]),
                r = Math.floor(e / 9) + 1,
                o = (e % 9) + 1;
            if (t.length !== 4 + 2 * o * r)
                throw new Error(
                    `blurhash length mismatch: length is ${
                        t.length
                    } but it should be ${4 + 2 * o * r}`
                );
        },
        s = (t) => {
            const e = (t >> 8) & 255,
                a = 255 & t;
            return [o(t >> 16), o(e), o(a)];
        },
        m = (t, e) => {
            const a = Math.floor(t / 361),
                r = Math.floor(t / 19) % 19,
                o = t % 19;
            return [
                n((a - 9) / 9, 2) * e,
                n((r - 9) / 9, 2) * e,
                n((o - 9) / 9, 2) * e,
            ];
        },
        c = (t, e, a, r) => {
            let h = 0,
                n = 0,
                l = 0;
            const s = 4 * e;
            for (let m = 0; m < e; m++)
                for (let e = 0; e < a; e++) {
                    const a = r(m, e);
                    (h += a * o(t[4 * m + 0 + e * s])),
                        (n += a * o(t[4 * m + 1 + e * s])),
                        (l += a * o(t[4 * m + 2 + e * s]));
                }
            let m = 1 / (e * a);
            return [h * m, n * m, l * m];
        };
    return (
        (t.decodePromise = (e, a, r, o = 1) =>
            new Promise((h, n) => {
                h(t.decode(e, a, r, o));
            })),
        (t.decode = (t, e, r, o = 1) => {
            l(t), (o |= 1);
            const n = a(t[0]),
                c = Math.floor(n / 9) + 1,
                i = (n % 9) + 1,
                M = (a(t[1]) + 1) / 166,
                g = new Array(i * c);
            for (let e = 0; e < g.length; e++)
                if (0 === e) {
                    const r = a(t.substring(2, 6));
                    g[e] = s(r);
                } else {
                    const r = a(t.substring(4 + 2 * e, 6 + 2 * e));
                    g[e] = m(r, M * o);
                }
            const f = 4 * e,
                d = new Uint8ClampedArray(f * r);
            for (let t = 0; t < r; t++)
                for (let a = 0; a < e; a++) {
                    let o = 0,
                        n = 0,
                        l = 0;
                    for (let h = 0; h < c; h++)
                        for (let s = 0; s < i; s++) {
                            const m =
                                Math.cos((Math.PI * a * s) / e) *
                                Math.cos((Math.PI * t * h) / r);
                            let c = g[s + h * i];
                            (o += c[0] * m), (n += c[1] * m), (l += c[2] * m);
                        }
                    let s = h(o),
                        m = h(n),
                        M = h(l);
                    (d[4 * a + 0 + t * f] = s),
                        (d[4 * a + 1 + t * f] = m),
                        (d[4 * a + 2 + t * f] = M),
                        (d[4 * a + 3 + t * f] = 255);
                }
            return d;
        }),
        (t.encodePromise = (e, a, r, o, h) =>
            new Promise((n, l) => {
                n(t.encode(e, a, r, o, h));
            })),
        (t.encode = (t, e, a, o, l) => {
            if (o < 1 || o > 9 || l < 1 || l > 9)
                throw new Error(
                    "BlurHash must have between 1 and 9 components"
                );
            if (e * a * 4 !== t.length)
                throw new Error("Width and height must match the pixels array");
            let s = [];
            for (let r = 0; r < l; r++)
                for (let h = 0; h < o; h++) {
                    const o = 0 == h && 0 == r ? 1 : 2,
                        n = c(
                            t,
                            e,
                            a,
                            (t, n) =>
                                o *
                                Math.cos((Math.PI * h * t) / e) *
                                Math.cos((Math.PI * r * n) / a)
                        );
                    s.push(n);
                }
            const m = s[0],
                i = s.slice(1);
            let M,
                g = "";
            if (((g += r(o - 1 + 9 * (l - 1), 1)), i.length > 0)) {
                let t = Math.max(...i.map((t) => Math.max(...t))),
                    e = Math.floor(
                        Math.max(0, Math.min(82, Math.floor(166 * t - 0.5)))
                    );
                (M = (e + 1) / 166), (g += r(e, 1));
            } else (M = 1), (g += r(0, 1));
            return (
                (g += r(
                    ((t) => {
                        return (h(t[0]) << 16) + (h(t[1]) << 8) + h(t[2]);
                    })(m),
                    4
                )),
                i.forEach((t) => {
                    g += r(
                        ((t, e) => {
                            return (
                                19 *
                                    Math.floor(
                                        Math.max(
                                            0,
                                            Math.min(
                                                18,
                                                Math.floor(
                                                    9 * n(t[0] / e, 0.5) + 9.5
                                                )
                                            )
                                        )
                                    ) *
                                    19 +
                                19 *
                                    Math.floor(
                                        Math.max(
                                            0,
                                            Math.min(
                                                18,
                                                Math.floor(
                                                    9 * n(t[1] / e, 0.5) + 9.5
                                                )
                                            )
                                        )
                                    ) +
                                Math.floor(
                                    Math.max(
                                        0,
                                        Math.min(
                                            18,
                                            Math.floor(
                                                9 * n(t[2] / e, 0.5) + 9.5
                                            )
                                        )
                                    )
                                )
                            );
                        })(t, M),
                        2
                    );
                }),
                g
            );
        }),
        (t.getImageData = (t) => {
            const e = t.width,
                a = t.height,
                r = document.createElement("canvas"),
                o = r.getContext("2d");
            return (
                (r.width = e),
                (r.height = a),
                (o.width = e),
                (o.height = a),
                o.drawImage(t, 0, 0),
                o.getImageData(0, 0, e, a).data
            );
        }),
        (t.drawImageDataOnNewCanvas = (t, e, a) => {
            const r = document.createElement("canvas"),
                o = r.getContext("2d");
            return (
                (r.width = e),
                (r.height = a),
                (o.width = e),
                (o.height = a),
                o.putImageData(new ImageData(t, e, a), 0, 0),
                r
            );
        }),
        (t.getImageDataAsImageWithOnloadPromise = (e, a, r) =>
            new Promise((o, h) => {
                t.getImageDataAsImage(e, a, r, (t, e) => {
                    o(e);
                });
            })),
        (t.getImageDataAsImage = (e, a, r, o) => {
            const h = t.drawImageDataOnNewCanvas(e, a, r).toDataURL(),
                n = new Image(a, r);
            return (
                (n.onload = (t) => o(t, n)),
                (n.width = a),
                (n.height = r),
                (n.src = h),
                n
            );
        }),
        t
    );
})({});
