import React from 'react';


export default function App() {
    return (<div className="text-black text-[16px] leading-[24px]" style={{ "fontFamily": "ui-sans-serif, system-ui, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"", "width": "1024px", "transform": "scale(1)", "margin": "auto" }}>
        <div className="bg-white text-[rgb(29,_32,_37)]" style={{ "textDecoration": "rgb(29, 32, 37)" }}>
            <div>
                <div aria-label="Notifications (F8)" role="region" className="pointer-events-none">
                    <ol className="flex flex-col pointer-events-none fixed w-full right-0 bottom-0 max-h-[640px] max-w-[420px] p-4 z-[100]"></ol>
                </div>
                <section aria-label="Notifications alt+T"></section>
                <div className="min-h-[640px]">
                    <nav className="border-b fixed left-0 top-0 right-0 backdrop-blur-xs bg-[rgba(29,_32,_37,_0.95)]/95 border-[rgba(48,_171,_232,_0.2)]/20 z-[50]">
                        <div className="ml-auto mr-auto w-full p-4">
                            <div className="items-center flex justify-between">
                                <a href="https://www.innsbruckcityapartments.com/" className="flex flex-col">
                                    <span className="block font-bold text-[rgb(48,_171,_232)] text-[24px] leading-[30px]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>Innsbruck</span>
                                    <span className="block font-light text-neutral-50 text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(250, 250, 250)" }}>City Apartments</span>
                                </a>
                                <div className="items-center flex">
                                    <a href="https://www.innsbruckcityapartments.com/" className="block font-medium text-[rgb(48,_171,_232)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>Home</a>
                                    <a href="https://www.innsbruckcityapartments.com/luxury" className="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(250, 250, 250)" }}>Luxury Units</a>
                                    <a href="https://www.innsbruckcityapartments.com/premium" className="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(250, 250, 250)" }}>Premium Units</a>
                                    <a href="https://www.innsbruckcityapartments.com/blog" className="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(250, 250, 250)" }}>Tirol Region</a>
                                    <a href="https://www.innsbruckcityapartments.com/contact" className="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(250, 250, 250)" }}>Contact</a>
                                    <a href="https://www.innsbruckcityapartments.com/contact" className="block ml-[32px]">
                                        <button className="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-[rgb(48,_171,_232)] text-[14px] gap-[8px] leading-[20px] pt-2 pr-4 pb-2 pl-4 rounded-md" style={{ "appearance": "button" }}>Request Info</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <section className="items-center flex h-screen justify-center overflow-hidden relative">
                        <div className="bg-center bg-cover absolute left-0 top-0 right-0 bottom-0" style={{ "backgroundImage": "url(\"https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media\")" }}>
                            <div className="absolute left-0 top-0 right-0 bottom-0" style={{ "backgroundImage": "linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6))" }}></div>
                        </div>
                        <div className="ml-auto mr-auto relative text-center max-w-4xl pt-0 pr-4 pb-0 pl-4 z-[10]">
                            <h1 className="font-bold text-center mb-[24px] text-neutral-50 text-[72px] leading-[72px]" style={{ "textDecoration": "rgb(250, 250, 250)" }}>
                                <span className="block text-center">Innsbruck City</span>
                                <span className="block text-center">Apartments</span>
                            </h1>
                            <p className="font-light text-center mb-[32px] text-neutral-50/90 text-[24px] leading-[32px] pt-0 pr-2 pb-0 pl-2" style={{ "textDecoration": "rgba(250, 250, 250, 0.9)" }}>In the heart of the mountains and the center of Innsbruck</p>
                            <div className="flex justify-center text-center gap-[16px] pt-0 pr-4 pb-0 pl-4">
                                <a href="https://www.innsbruckcityapartments.com/luxury" className="block text-center">
                                    <button className="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-[rgb(48,_171,_232)] text-[18px] gap-[8px] leading-[28px] pt-2 pr-8 pb-2 pl-8 rounded-md" style={{ "appearance": "button" }}>Explore Luxury Units</button>
                                </a>
                                <a href="https://www.innsbruckcityapartments.com/premium" className="block text-center">
                                    <button className="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-white border-neutral-50 border-[2px] text-black text-[18px] gap-[8px] leading-[28px] pt-2 pr-8 pb-2 pl-8 rounded-md" style={{ "appearance": "button" }}>View Premium Units</button>
                                </a>
                            </div>
                        </div>
                    </section>
                    <section className="bg-white pt-20 pr-0 pb-20 pl-0">
                        <div className="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4">
                            <div className="text-center mb-[64px]">
                                <h2 className="font-bold text-center mb-[16px] text-[36px] leading-[40px]">Benefits of Innsbruck City Apartments</h2>
                                <p className="ml-auto mr-auto text-center text-[rgb(107,_114,_128)] text-[18px] leading-[28px] max-w-2xl" style={{ "textDecoration": "rgb(107, 114, 128)" }}>Discover our Luxury and Premium apartments</p>
                            </div>
                            <div className="grid gap-[32px]" style={{ "gridTemplateColumns": "repeat(4, minmax(0px, 1fr))" }}>
                                <div className="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                                    <div className="text-center p-6">
                                        <div className="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Ff579f8082ff20add84f3d7bf7489a737e77b858d.svg?generation=1770502588640546&amp;alt=media" className="block size-full" />
                                        </div>
                                        <h3 className="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">Prime Location</h3>
                                        <p className="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>Located in the city center of Innsbruck, walking distance from all attractions</p>
                                    </div>
                                </div>
                                <div className="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                                    <div className="text-center p-6">
                                        <div className="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F89efef4fe1312d57ce4896232a6aa8c6e827b587.svg?generation=1770502588604791&amp;alt=media" className="block size-full" />
                                        </div>
                                        <h3 className="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">Luxury Amenities</h3>
                                        <p className="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>Premium furnishings and modern facilities designed for ultimate comfort</p>
                                    </div>
                                </div>
                                <div className="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                                    <div className="text-center p-6">
                                        <div className="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F964336d17be7fa52b0e996550bb4cdc92db132a5.svg?generation=1770502588601630&amp;alt=media" className="block size-full" />
                                        </div>
                                        <h3 className="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">City Center</h3>
                                        <p className="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>World-class skiing, dining, and cultural attractions</p>
                                    </div>
                                </div>
                                <div className="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                                    <div className="text-center p-6">
                                        <div className="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F3851596ebcb7a7232c991ed3bdbaee6b11f9b67f.svg?generation=1770502588650601&amp;alt=media" className="block size-full" />
                                        </div>
                                        <h3 className="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">Business Travel</h3>
                                        <p className="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>Perfect environment for business trips with high- speed internet and dedicated workspace</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="bg-white pt-20 pr-0 pb-20 pl-0">
                        <div className="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4">
                            <div className="text-center mb-[64px]">
                                <h2 className="font-bold text-center mb-[16px] text-[36px] leading-[40px]">Our Properties</h2>
                                <p className="text-center text-[rgb(107,_114,_128)] text-[18px] leading-[28px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>Choose from our Premium and Luxury apartments</p>
                            </div>
                            <div className="grid gap-[32px]" style={{ "gridTemplateColumns": "repeat(2, minmax(0px, 1fr))" }}>
                                <div className="border overflow-hidden bg-white border-gray-200 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                                    <div className="overflow-hidden relative h-80">
                                        <img alt="Luxury apartments with mountain views" src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F9ed7d824b867c563836fa0e11722551307a341e2.jpg?generation=1770502588609302&amp;alt=media" className="block size-full max-w-full object-cover overflow-clip align-middle" />
                                        <div className="absolute left-0 top-0 right-0 bottom-0" style={{ "backgroundImage": "linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0))" }}></div>
                                        <div className="absolute left-0 right-0 bottom-0 text-neutral-50 p-6" style={{ "textDecoration": "rgb(250, 250, 250)" }}>
                                            <h3 className="font-bold mb-[8px] text-[30px] leading-[36px]">Luxury Units</h3>
                                            <p className="mb-[16px] text-neutral-50/90" style={{ "textDecoration": "rgba(250, 250, 250, 0.9)" }}>2 exclusive apartments with premium features</p>
                                            <a href="https://www.innsbruckcityapartments.com/luxury">
                                                <button className="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-9 bg-[rgb(48,_171,_232)] text-[rgb(29,_32,_37)] text-[14px] gap-[8px] leading-[20px] pt-0 pr-3 pb-0 pl-3 rounded-md" style={{ "appearance": "button", "textDecoration": "rgb(29, 32, 37)" }}>View Details</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div className="border overflow-hidden bg-white border-gray-200 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                                    <div className="overflow-hidden relative h-80">
                                        <img alt="Premium apartments with alpine views" src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fe80c0ec2797a5b386d4b98536b8fbf068eb92144.jpg?generation=1770502588676156&amp;alt=media" className="block size-full max-w-full object-cover overflow-clip align-middle" />
                                        <div className="absolute left-0 top-0 right-0 bottom-0" style={{ "backgroundImage": "linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0))" }}></div>
                                        <div className="absolute left-0 right-0 bottom-0 text-neutral-50 p-6" style={{ "textDecoration": "rgb(250, 250, 250)" }}>
                                            <h3 className="font-bold mb-[8px] text-[30px] leading-[36px]">Premium Units</h3>
                                            <p className="mb-[16px] text-neutral-50/90" style={{ "textDecoration": "rgba(250, 250, 250, 0.9)" }}>4 stylish apartments with modern comfort</p>
                                            <a href="https://www.innsbruckcityapartments.com/premium">
                                                <button className="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-9 bg-[rgb(48,_171,_232)] text-[rgb(29,_32,_37)] text-[14px] gap-[8px] leading-[20px] pt-0 pr-3 pb-0 pl-3 rounded-md" style={{ "appearance": "button", "textDecoration": "rgb(29, 32, 37)" }}>View Details</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="overflow-hidden relative bg-[rgb(29,_32,_37)] text-neutral-50 pt-20 pr-0 pb-20 pl-0" style={{ "textDecoration": "rgb(250, 250, 250)" }}>
                        <div className="absolute left-0 top-0 right-0 bottom-0" style={{ "backgroundImage": "linear-gradient(rgba(29, 32, 37, 0.4), rgba(29, 32, 37, 0.8), rgb(29, 32, 37))" }}></div>
                        <div className="ml-auto mr-auto relative text-center w-full pt-0 pr-4 pb-0 pl-4 z-[10]">
                            <h2 className="font-bold text-center mb-[24px] text-[36px] leading-[40px] pt-0 pr-2 pb-0 pl-2">Request your luxury or premium apartment in the center of Innsbruck</h2>
                            <p className="ml-auto mr-auto text-center mb-[32px] text-neutral-50/90 text-[20px] leading-[28px] max-w-2xl" style={{ "textDecoration": "rgba(250, 250, 250, 0.9)" }}>Contact us today to request information about availability</p>
                            <div className="text-center">
                                <a href="https://www.innsbruckcityapartments.com/contact" className="text-center">
                                    <button className="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-[rgb(48,_171,_232)] text-[rgb(29,_32,_37)] text-[18px] gap-[8px] leading-[28px] pt-2 pr-12 pb-2 pl-12 rounded-md" style={{ "appearance": "button", "textDecoration": "rgb(29, 32, 37)" }}>Request Booking</button>
                                </a>
                            </div>
                        </div>
                    </section>
                    <footer className="bg-[rgb(29,_32,_37)] text-neutral-50" style={{ "textDecoration": "rgb(250, 250, 250)" }}>
                        <div className="ml-auto mr-auto w-full pt-12 pr-4 pb-12 pl-4">
                            <div className="grid gap-[32px]" style={{ "gridTemplateColumns": "repeat(3, minmax(0px, 1fr))" }}>
                                <div>
                                    <h3 className="font-bold mb-[16px] text-[rgb(48,_171,_232)] text-[20px] leading-[28px]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>Innsbruck City Apartments</h3>
                                    <p className="mb-[16px] text-[rgb(107,_114,_128)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>We believe in providing personalized service. By requesting information, we can ensure you get the perfect apartment for your needs and answer any questions you may have.</p>
                                </div>
                                <div>
                                    <h4 className="font-semibold mb-[16px] text-[18px] leading-[28px]">Quick Links</h4>
                                    <ul>
                                        <li className="list-none text-left">
                                            <a href="https://www.innsbruckcityapartments.com/luxury" className="text-left text-[14px] leading-[20px]">Luxury Units</a>
                                        </li>
                                        <li className="list-none text-left mt-[8px]">
                                            <a href="https://www.innsbruckcityapartments.com/premium" className="text-left text-[14px] leading-[20px]">Premium Units</a>
                                        </li>
                                        <li className="list-none text-left mt-[8px]">
                                            <a href="https://www.innsbruckcityapartments.com/blog" className="text-left text-[14px] leading-[20px]">Tirol Region</a>
                                        </li>
                                        <li className="list-none text-left mt-[8px]">
                                            <a href="https://www.innsbruckcityapartments.com/contact" className="text-left text-[14px] leading-[20px]">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 className="font-semibold mb-[16px] text-[18px] leading-[28px]">Contact Info</h4>
                                    <ul>
                                        <li className="items-start flex text-left">
                                            <div className="fill-none overflow-hidden text-left align-middle w-5 h-5 mt-[2px] text-[rgb(48,_171,_232)] shrink-[0]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                                <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb9f65246b7034767fc11ea611be60edcbab724d3.svg?generation=1770502588613710&amp;alt=media" className="block size-full" />
                                            </div>
                                            <span className="block text-left ml-[12px] text-[14px] leading-[20px]">Heiliggeiststrasse 2/2a/2b, 6020 Innsbruck, Austria</span>
                                        </li>
                                        <li className="items-start flex text-left mt-[12px]">
                                            <div className="fill-none overflow-hidden text-left align-middle w-5 h-5 mt-[2px] text-[rgb(48,_171,_232)] shrink-[0]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                                <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb0caa86e1509e75195dbf4f52e6266e757f7654d.svg?generation=1770502588646930&amp;alt=media" className="block size-full" />
                                            </div>
                                            <div className="text-left ml-[12px] text-[14px] leading-[20px]">
                                                <span className="block text-left text-[rgb(48,_171,_232)] text-[12px] leading-[16px]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>WhatsApp Preferred</span>
                                                <span className="text-left">+43 660 478 47 12</span>
                                            </div>
                                        </li>
                                        <li className="items-start flex text-left mt-[12px]">
                                            <div className="fill-none overflow-hidden text-left align-middle w-5 h-5 mt-[2px] text-[rgb(48,_171,_232)] shrink-[0]" style={{ "textDecoration": "rgb(48, 171, 232)" }}>
                                                <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb9ef28536579510dac0407f4da4001e46535cfe7.svg?generation=1770502588640506&amp;alt=media" className="block size-full" />
                                            </div>
                                            <span className="block text-left ml-[12px] text-[14px] leading-[20px]">ibk.cityapartments@gmail.com</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div className="border-t text-center mt-[32px] border-[rgba(48,_171,_232,_0.2)]/20 pt-8 pr-0 pb-0 pl-0">
                                <p className="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]" style={{ "textDecoration": "rgb(107, 114, 128)" }}>©  2026  Innsbruck City Apartments. All rights reserved.</p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>);
}
