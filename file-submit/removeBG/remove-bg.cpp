#include <iostream>
#include <filesystem>
#include <opencv2/opencv.hpp>
#include <vector>
#include "opencv2/imgcodecs.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgproc.hpp"

cv::Mat main_image;

bool removeBG(std::string fname) {
	cv::Mat new_gray;
	cv::cvtColor(main_image, new_gray, cv::COLOR_BGR2GRAY);
	
	cv::Mat mask;
	cv::threshold(new_gray, mask, 0, 255, cv::THRESH_BINARY + cv::THRESH_OTSU);

	cv::Mat res;
	cv::bitwise_and(main_image, main_image, res, mask);

	cv::Mat alpha;
	cv::threshold(mask, alpha, 0, 255, cv::THRESH_BINARY_INV);

	std::vector<cv::Mat> channels;
	cv::split(res, channels);
	channels.push_back(alpha);

	cv::Mat new_res;
	cv::merge(channels, new_res);


	std::string path = "/var/www/html/uploads/removedBG/" + fname + ".png";
	// std::cout << "path: " << path << '\n'; 
	cv::imwrite(path, new_res);

	// cv::imshow("mask", mask);
	// cv::imshow("alpha", alpha);
	// cv::waitKey(0);
	// cv::destroyAllWindows();

	return true;
}

int main(int argc, char const *argv[]) {
	std::string filename = "";
	std::filesystem::path path;

	if (argc > 1) {
		path = std::filesystem::path(argv[1]); 
		filename = path.filename();
	}

	main_image = cv::imread(argv[1], cv::IMREAD_COLOR);

	if (removeBG(filename)) {
		std::cout << "uploads/" << filename << '\n';
		return 0;
	} else {
		return 1;
	} 
}