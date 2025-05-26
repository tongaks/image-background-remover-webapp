#include <iostream>
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
	cv::threshold(mask, alpha, 0, 255, cv::THRESH_BINARY);

	std::vector<cv::Mat> channels;
	cv::split(res, channels);
	channels.push_back(alpha);

	cv::Mat new_res;
	cv::merge(channels, new_res);

	std::string path = "../../uploads" + fname + ".png";
	cv::imwrite(path, new_res);
	return true;
}

int main(int argc, char const *argv[]) {
	std::string path = "";
	if (argc > 1) {
		path = argv[1];
	}

	main_image = cv::imread(path, cv::IMREAD_COLOR);

	if (removeBG(path))
		return 0;
	else return 1;
}